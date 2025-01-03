<?php
namespace App\Services;

use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Repositories\Book\BookRepositoryInterface;
use App\Repositories\Order\OrderRepositoryInterface;
use function Pest\Laravel\json;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class OrderService
{
    protected $orderRepository;

    protected $bookRepository;

    protected $paymentService;

    public function __construct(OrderRepositoryInterface $orderRepository, BookRepositoryInterface $bookRepository, PaymentService $paymentService)
    {
        $this->orderRepository = $orderRepository;
        $this->bookRepository = $bookRepository;
        $this->paymentService = $paymentService;
    }

    public function create($data = [])
    {

        $itemOrder = $data['items'];

        $bookIds = array_column($itemOrder, 'book_id');

        $books = $this->bookRepository->getBookInArrId($bookIds);

        $user = Auth::user();

        $shipping_address = $data['shipping_address'];

        $apiUrl = 'https://dev-online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/fee';

        $totalShippingFee = 0; // phí ship

        $totalWeight = 0; // tổng cân nặng

        $totalLength = 0; // tổng chiều dài

        $totalWidth = 0; // tổng chiều rộng

        $totalHeight = 0; // tổng chiều cao

        $totalQuantity = 0; // tổng số lượng

        $totalPrice = 0; // tổng giá cac sản phẩm

        $totalDiscount = 0; // tổng giảm giá

        foreach ($itemOrder as $index => $item) {
            $totalQuantity += $item['quantity'];

            $book = $books->where('id', $item['book_id'])->load('discountTiers')->first();

            $discountTiers = $book->discountTiers ? $book->discountTiers->toArray() : [];

            usort($discountTiers, function ($a, $b) {
                return $b['minimum_quantity'] <=> $a['minimum_quantity']; // Sắp xếp giảm dần theo số lượng tối thiểu
            });

            if ($user->role->name == 'company') {
                $tierFound = collect($discountTiers)->first(function ($tier) use ($item) {
                    return $item['quantity'] >= $tier['minimum_quantity'];
                });

                if ($tierFound) {

                    $itemOrder[$index]['discount'] = 0;
                    $itemOrder[$index]['price'] = $tierFound['price'];

                    $totalDiscount += 0;
                    $totalPrice += $tierFound['price'] * $item['quantity'];
                } else {
                    // tính tổng giảm giá
                    $totalDiscount += ($book->price * $book->discount / 100) * $item['quantity'];
                    $totalPrice += ($book->price * (100 - $book->discount) / 100) * $item['quantity'];
                }

            } else {
                // tính tổng giá sản phẩm sau khi giảm giá
                $totalPrice += ($book->price * (100 - $book->discount) / 100) * $item['quantity'];
                // tính tổng giảm giá
                $totalDiscount += ($book->price * $book->discount / 100) * $item['quantity'];
            }
        }

        if ($totalQuantity < 10) {
            foreach ($itemOrder as $item) {
                $book = $books->where('id', $item['book_id'])->first();

                $totalWeight += $book->weight * $item['quantity'];

                $totalHeight += $book->height * $item['quantity'];
            }

            // Convert mảng
            $booksArray = $books->toArray();

            // Lấy chiều dài lớn nhất
            $totalLength = max(array_map(function ($item) {
                return $item['dimension_length'];
            }, $booksArray));

            // Lấy chiều rộng lớn nhất
            $totalWidth = max(array_map(function ($item) {
                return $item['dimension_width'];
            }, $booksArray));

            $postData = [
                'shop_id' => (int) config('app.ghn_shop_id'),
                'service_id' => 53321,
                'to_district_id' => $shipping_address['district']['DistrictID'],
                'to_ward_code' => $shipping_address['ward']['WardCode'],
                'service_type_id' => 2,
                'weight' => ceil($totalWeight),
                'length' => ceil($totalLength),
                'width' => ceil($totalWidth),
                'height' => ceil($totalHeight),
            ];

            $headerData = [
                'Content-Type' => 'application/json',
                'token' => config('app.ghn_token'),
            ];

            // return $postData;

            $response = Http::withHeaders($headerData)->post($apiUrl, $postData);

            $statusResponse = $response->status();

            if ($statusResponse == 200) {
                $totalShippingFee = $response->json()['data']['total'];
            }

        }

        $finalPrice = $totalPrice + $totalShippingFee;

        unset($shipping_address['id'], $shipping_address['user_id']);

        $dataCreateOrder = [
            'user_id' => $user->id,
            'total_amount' => $totalPrice,
            'shipping_fee' => $totalShippingFee,
            'discount_amount' => $totalDiscount,
            'final_amount' => $finalPrice,
            'shipping_address' => json_encode($shipping_address),
            'payment_method' => $data['payment_method'],
        ];

        if ($data['shipping_address'] == null) {

        }

        if ($data['payment_method'] == PaymentMethod::BANK_TRANSFER) {
            $dataCreateOrder['status'] = OrderStatus::NOT_PAID;
        }

        DB::beginTransaction();

        try {
            $order = $this->orderRepository->create($dataCreateOrder);

            $order->orderItems()->createMany($itemOrder);

            DB::commit();

            if ($data['payment_method'] == PaymentMethod::BANK_TRANSFER) {
                $url = $this->paymentService->createPayment([
                    'order_id' => $order->id,
                    'order_info' => 'Thanh toán đơn hàng',
                    'amount' => $finalPrice,
                    'vnp_ReturnUrl' => config('app.url') . '/api/order/' . $order->id . '/payment-return',
                ]);
                return $url;
            } else {
                return $order;

            }
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updateStatusAfterPayment($id, $data)
    {
        $checkPayment = $this->paymentService->checkPayment($data);

        if ($checkPayment) {

            $dataUpdate = [
                'status' => OrderStatus::PENDING,
                'payment_date' => date('Y-m-d', strtotime($data['vnp_PayDate'])),
                'transaction_id' => $data['vnp_TransactionNo'], // mã giao dịch
                'ref_id' => $data['vnp_TxnRef'], // mã đơn hàng
            ];

            $this->orderRepository->update($data['vnp_TxnRef'], $dataUpdate);

            return redirect()->away(config('app.frontend_url') . '/checkout?status=success');

        }

        return redirect()->away(config('app.frontend_url') . '/checkout?status=fail');

    }

    public function getAll($paginate = null, $with = [], $filter = null, $sort = null)
    {
        return $this->orderRepository->getAll($paginate, $with, $filter, $sort);
    }

    public function show($id, $with = [])
    {
        return $this->orderRepository->show($id, $with);
    }

    public function update($id, $data)
    {
        $status = $data['status'];

        if ($status == OrderStatus::CANCELLED) {
            $order = $this->orderRepository->find($id);

            if ($order->payment_method == PaymentMethod::BANK_TRANSFER) {
                if ($order->transaction_id != null && $order->ref_id != null) {
                    return abort(400, 'Đơn hàng đã được thanh toán không thể hủy');
                }
            }
        }

        $oldStatus = $this->orderRepository->find($id)->status;

        $update = $this->orderRepository->update($id, $data);
        if ($update) {
            if ($oldStatus != $status) {
                $order = $this->orderRepository->find($id)->with(['orderItems.book'])->first();
                $user = $this->orderRepository->find($id)->user;
                $this->orderRepository->sendMailOrderStatus($order, $user);
            }
            return $update;
        }
        return false;
    }

    public function myOrder($paginate = null, $with = [], $filter = null, $sort = null)
    {
        return $this->orderRepository->myOrder($paginate, $with, $filter, $sort);
    }
}
