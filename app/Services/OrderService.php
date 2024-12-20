<?php
namespace App\Services;

use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Repositories\Book\BookRepositoryInterface;
use App\Repositories\Order\OrderRepositoryInterface;
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

        // post api tính phí ship GHN

        $apiUrl = 'https://dev-online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/fee';

        $totalShippingFee = 0; // phí ship

        $totalWeight = 0; // tổng cân nặng

        $totalLength = 0; // tổng chiều dài

        $totalWidth = 0; // tổng chiều rộng

        $totalHeight = 0; // tổng chiều cao

        $totalQuantity = 0; // tổng số lượng

        $totalPrice = 0; // tổng giá cac sản phẩm

        $totalDiscount = 0; // tổng giảm giá

        foreach ($itemOrder as $item) {
            $totalQuantity += $item['quantity'];

            $book = $books->where('id', $item['book_id'])->first();

            // tính tổng giá sản phẩm sau khi giảm giá

            $totalPrice += ($book->price * (100- $book->discount)/100) * $item['quantity'];

            // tính tổng giảm giá

            $totalDiscount += ($book->price * $book->discount/100) * $item['quantity'];
        }

        if ($totalQuantity <= 10) {
            foreach ($itemOrder as $item) {
                $book = $books->where('id', $item['book_id'])->first();

                $totalWeight += $book->weight * $item['quantity'];

                $totalLength += $book->length * $item['quantity'];

                $totalWidth += $book->width * $item['quantity'];

                $totalHeight += $book->height * $item['quantity'];
            }

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

            $response = Http::withHeaders($headerData)->post($apiUrl, $postData);

            $statusResponse = $response->status();

            if ($statusResponse == 200) {
                $totalShippingFee = $response->json()['data']['total'];
            }

        }

        $finalPrice = $totalPrice + $totalShippingFee;

        $dataCreateOrder = [
            'user_id' => $user->id,
            'total_amount' => $totalPrice,
            'shipping_fee' => $totalShippingFee,
            'discount_amount' => $totalDiscount,
            'final_amount' => $finalPrice,
            'payment_method' => $data['payment_method'],
        ];

        if($data['payment_method'] == PaymentMethod::BANK_TRANSFER) {
            $dataCreateOrder['status'] = OrderStatus::NOT_PAID;
        }

        DB::beginTransaction();

        try {
            $order = $this->orderRepository->create($dataCreateOrder);

            $order->orderItems()->createMany($itemOrder);

            DB::commit();

            if($data['payment_method'] == PaymentMethod::BANK_TRANSFER) {
                $url = $this->paymentService->createPayment([
                    'order_id' => $order->id,
                    'order_info' => 'Thanh toán đơn hàng',
                    'amount' => $finalPrice,
                    'vnp_ReturnUrl' => config('app.url').'/api/order/'.$order->id.'/payment-return',
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

        if($checkPayment) {

            $dataUpdate = [
                'status' => OrderStatus::PENDING,
                //convert "vnp_PayDate": "20241219142301", to date not datetime
                'payment_date' => date('Y-m-d', strtotime($data['vnp_PayDate'])),
                'transaction_id' => $data['vnp_TransactionNo'], // mã giao dịch
                'ref_id' => $data['vnp_TxnRef'], // mã đơn hàng
            ];

            $order = $this->orderRepository->update($data['vnp_TxnRef'], $dataUpdate);

            return $order;
        }
        //replace route sang port 3000

        // return redirect()->away(config('app.frontend_url'));

    }
}
