<?php

namespace App\Providers;

use App\Models\Book;
use App\Repositories\Auth\AuthRepository;
use App\Repositories\Auth\AuthRepositoryInterface;
use App\Repositories\Author\AuthorRepository;
use App\Repositories\Author\AuthorRepositoryInterface;
use App\Repositories\AuthorsBook\AuthorsBookRepository;
use App\Repositories\AuthorsBook\AuthorsBookRepositoryInterface;
use App\Repositories\Book\BookRepository;
use App\Repositories\Book\BookRepositoryInterface;
use App\Repositories\BookTransaction\BookTransactionRepository;
use App\Repositories\BookTransaction\BookTransactionRepositoryInterface;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\DiscountTiers\DiscountTiersRepository;
use App\Repositories\DiscountTiers\DiscountTiersRepositoryInterface;
use App\Repositories\Order\OrderRepository;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\OrderItem\OrderItemRepository;
use App\Repositories\OrderItem\OrderItemRepositoryInterface;
use App\Repositories\Payment\PaymentRepository;
use App\Repositories\Payment\PaymentRepositoryInterface;
use App\Repositories\Promotion\PromotionRepository;
use App\Repositories\Promotion\PromotionRepositoryInterface;
use App\Repositories\Publisher\PublisherRepository;
use App\Repositories\Publisher\PublisherRepositoryInterface;
use App\Repositories\Review\ReviewRepository;
use App\Repositories\Review\ReviewRepositoryInterface;
use App\Repositories\Role\RoleRepository;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Repositories\ShippingAddress\ShippingAddressRepository;
use App\Repositories\ShippingAddress\ShippingAddressRepositoryInterface;
use App\Repositories\ShoppingCart\ShoppingCartRepository;
use App\Repositories\ShoppingCart\ShoppingCartRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */

    public $singletons = [
        UserRepositoryInterface::class => UserRepository::class, // Đăng ký interface UserRepositoryInterface với class UserRepository
        AuthRepositoryInterface::class => AuthRepository::class,
        RoleRepositoryInterface::class => RoleRepository::class,
        PublisherRepositoryInterface::class => PublisherRepository::class,
        CategoryRepositoryInterface::class => CategoryRepository::class,
        BookRepositoryInterface::class => BookRepository::class,
        OrderRepositoryInterface::class => OrderRepository::class,
        ShippingAddressRepositoryInterface::class => ShippingAddressRepository::class,
        AuthorRepositoryInterface::class => AuthorRepository::class,
        OrderItemRepositoryInterface::class => OrderItemRepository::class,
        ReviewRepositoryInterface::class => ReviewRepository::class,
        ShoppingCartRepositoryInterface::class => ShoppingCartRepository::class,
        BookTransactionRepositoryInterface::class => BookTransactionRepository::class,
        AuthorsBookRepositoryInterface::class => AuthorsBookRepository::class,
        PromotionRepositoryInterface::class => PromotionRepository::class,
        DiscountTiersRepositoryInterface::class=>DiscountTiersRepository::class,
        PaymentRepositoryInterface::class=>PaymentRepository::class,
    ];

    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(function (\SocialiteProviders\Manager\SocialiteWasCalled $event) {
            $event->extendSocialite('google', \SocialiteProviders\Google\Provider::class);
        });
    }
}
