<?php
namespace App\Services;

use App\Enums\AccountStatus;
use App\Enums\OrderStatus;
use App\Repositories\Author\AuthorRepositoryInterface;
use App\Repositories\Book\BookRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\Promotion\PromotionRepositoryInterface;
use App\Repositories\Publisher\PublisherRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Carbon\Carbon;

class StatisticalService
{
    protected $orderRepository, $bookRepository, $userRepository, $categoryRepository, $publisherRepository,
    $authorRepository, $promotionRepository;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        BookRepositoryInterface $bookRepository,
        UserRepositoryInterface $userRepository,
        CategoryRepositoryInterface $categoryRepository,
        PublisherRepositoryInterface $publisherRepository,
        AuthorRepositoryInterface $authorRepository,
        PromotionRepositoryInterface $promotionRepository
    ) {
        $this->orderRepository = $orderRepository;
        $this->bookRepository = $bookRepository;
        $this->userRepository = $userRepository;
        $this->categoryRepository = $categoryRepository;
        $this->publisherRepository = $publisherRepository;
        $this->authorRepository = $authorRepository;
        $this->promotionRepository = $promotionRepository;
    }

    public function index()
    {
        //tinhs tong doanh thu
        $totalRevenue = 0; //tổng doanh thu
        $totalBook = 0; //tổng các cuốn sách
        $totalOrder = 0; //tổng các đơn hàng
        $totalUser = 0; //tổng số người dùng
        $totalCategory = 0; //tổng số danh mục
        $totalPublisher = 0; //tổng số nhà xuất bản
        $totalAuthor = 0; //tổng số tác giả
        $totalPromotion = 0; //tổng số khuyến mãi
        // $totalComment = 0; //tổng số bình luận
        // $totalRating = 0; //tổng số đánh giá
        $totalOrderSuccess = 0; //tổng số đơn hàng thành công
        $totalOrderPending = 0; //tổng số đơn hàng đang chờ xử lý
        $totalOrderCancel = 0; //tổng số đơn hàng đã hủy
        $totalOrderShipping = 0; //tổng số đơn hàng đang giao

        $start_date = Carbon::now()->subYears(10)->format('Y-m-d');
        $end_date = Carbon::now()->tomorrow()->format('Y-m-d');

        //tính tổng doanh thu
        $totalRevenue = $this->orderRepository->getTotalRevenue($start_date, $end_date);

        //tính tổng số sách
        $totalBook = $this->bookRepository->getAll()->count();

        //tính tổng số đơn hàng
        $totalOrder = $this->orderRepository->getAll()->count();

        //tính tổng số người dùng
        $totalUser = $this->userRepository->getAll()->where('status', AccountStatus::ACTIVE)->count();

        //tính tổng số danh mục
        $totalCategory = $this->categoryRepository->getAll()->count();

        //tính tổng số nhà xuất bản
        $totalPublisher = $this->bookRepository->getAll()->count();

        //tính tổng số tác giả
        $totalAuthor = $this->authorRepository->getAll()->count();

        //tính tổng số khuyến mãi
        $totalPromotion = $this->promotionRepository->getAll()->count();

        //tính tổng số đơn hàng thành công
        $totalOrderSuccess = $this->orderRepository->getAll()->where('status', OrderStatus::DELIVERED)->where('created_at', '>=', $start_date)->where('created_at', '<=', $end_date)->count();

        //tính tổng số đơn hàng đang chờ xử lý
        $totalOrderPending = $this->orderRepository->getAll()->where('status', OrderStatus::PENDING)->where('created_at', '>=', $start_date)->where('created_at', '<=', $end_date)->count();

        //tính tổng số đơn hàng đã hủy
        $totalOrderCancel = $this->orderRepository->getAll()->where('status', OrderStatus::CANCELLED)->where('created_at', '>=', $start_date)->where('created_at', '<=', $end_date)->count();

        //tính tổng số đơn hàng đang giao
        $totalOrderShipping = $this->orderRepository->getAll()->where('status', OrderStatus::SHIPPING)->where('created_at', '>=', $start_date)->where('created_at', '<=', $end_date)->count();

        return [
            [
                'name' => 'Tổng doanh thu',
                'value' => $totalRevenue
            ],

            [
                'name' => 'Tổng số sách',
                'value' => $totalBook
            ],

            [
                'name' => 'Tổng số đơn hàng',
                'value' => $totalOrder
            ],

            [
                'name' => 'Tổng số người dùng',
                'value' => $totalUser
            ],

            [
                'name' => 'Tổng số danh mục',
                'value' => $totalCategory
            ],

            [
                'name' => 'Tổng số nhà xuất bản',
                'value' => $totalPublisher
            ],

            [
                'name' => 'Tổng số tác giả',
                'value' => $totalAuthor
            ],

            [
                'name' => 'Tổng số khuyến mãi',
                'value' => $totalPromotion
            ],

            [
                'name' => 'Tổng số đơn hàng thành công',
                'value' => $totalOrderSuccess
            ],

            [
                'name' => 'Tổng số đơn hàng đang chờ xử lý',
                'value' => $totalOrderPending
            ],

            [
                'name' => 'Tổng số đơn hàng đã hủy',
                'value' => $totalOrderCancel
            ],

            [
                'name' => 'Tổng số đơn hàng đang giao',
                'value' => $totalOrderShipping
            ]

        ];
    }
    public function getRevenueByTime($start_date, $end_date, $optionShow)
    {
        $orderData = [];
        $labels = [];

        switch ($optionShow) {
            case 'today':
                $labels = ['0h', '3h', '6h', '9h', '12h', '15h', '18h', '21h', '24h'];
                $orders = $this->orderRepository->getRevenueByTime($start_date, $end_date, $optionShow);
                // return $orders;
                $orderData = array_fill(0, 9, 0);
                foreach ($orders as $order) {
                    $index = floor($order->time / 3);
                    $orderData[$index] = floatval($order->revenue);
                }
                break;

            case 'yesterday':
                $labels = ['0h', '3h', '6h', '9h', '12h', '15h', '18h', '21h', '24h'];
                $orders = $this->orderRepository->getRevenueByTime($start_date, $end_date, $optionShow);
                $orderData = array_fill(0, 9, 0);
                foreach ($orders as $order) {
                    $index = floor($order->hour / 3);
                    $orderData[$index] = $order->revenue;
                }
                break;

            case 'this_week':
                $labels = ['Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7', 'Chủ nhật'];
                $orders = $this->orderRepository->getRevenueByTime($start_date, $end_date, $optionShow);
                $orderData = array_fill(0, 7, 0);

                foreach ($orders as $order) {
                    $index = $order->time - 2;
                    if ($index >= 0 && $index < 7) {
                        $orderData[$index] = floatval($order->revenue);
                    }
                }

                break;

            case 'this_month':
                $labels = range(1, 30);
                $orders = $this->orderRepository->getRevenueByTime($start_date, $end_date, $optionShow);
                $orderData = array_fill(0, 30, 0);
                foreach ($orders as $order) {
                    $orderData[$order->time - 1] = floatval($order->revenue);
                }
                break;

            case 'this_year':
                $labels = range(1, 12);
                $orders = $this->orderRepository->getRevenueByTime($start_date, $end_date, $optionShow);
                $orderData = array_fill(0, 12, 0);
                foreach ($orders as $order) {
                    $index = $order->time - 1;
                    if ($index >= 0 && $index < 12) {
                        $orderData[$index] = floatval($order->revenue);
                    }

                }
                break;

            case 'all':
                $labels = range(Carbon::now()->year - 6, Carbon::now()->year);
                $orders = $this->orderRepository->getRevenueByTime($start_date, $end_date, $optionShow);
                $orderData = array_fill(0, 7, 0);
                foreach ($orders as $order) {
                    $index = $order->time - (Carbon::now()->year - 6);
                    if ($index >= 0 && $index < 7) {
                        $orderData[$index] = ceil($order->revenue);
                    }
                }
        }

        return [
            'labels' => $labels,
            'data' => $orderData,
        ];
    }

    public function getTop10BestSeller($start_date, $end_date, $optionShow)
    {
        return $this->bookRepository->getTop10BestSeller($start_date, $end_date, $optionShow);
    }

    public function getTop10Customer($start_date, $end_date, $optionShow)
    {
        return $this->userRepository->getTop10Customer($start_date, $end_date, $optionShow);
    }
}
