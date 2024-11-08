<?php

namespace App\Providers;

use App\Repositories\Auth\AuthRepository;
use App\Repositories\Auth\AuthRepositoryInterface;
use App\Repositories\Role\RoleRepository;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        /**
         * Register the User Repository
         */
        $this->app->singleton(
           UserRepositoryInterface::class,
           UserRepository::class
        );

        /**
         * Register the Auth Repository
         */
        $this->app->singleton(
            AuthRepositoryInterface::class,
            AuthRepository::class
        );

        /**
         * Register the Role Repository
         */
        $this->app->singleton(
            RoleRepositoryInterface::class,
            RoleRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
