<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\User\src\Repositories\UserRepository;
use Modules\User\src\Repositories\UserRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->singleton(
            UserRepositoryInterface::class,
            UserRepository::class
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
