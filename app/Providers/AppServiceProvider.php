<?php

namespace App\Providers;

use App\Enum\OrderStatusEnum;
use App\Enum\ProductStatusEnum;
use App\Enum\ProductUnitEnum;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Enum\CalendarColorEnum;
use App\Services\ProductService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        app()->bind('ProductUnitEnum', function () {
            return new ProductUnitEnum();
        });

        app()->bind('OrderStatusEnum', function () {
            return new OrderStatusEnum();
        });

        app()->bind('ProductStatusEnum', function () {
            return new ProductStatusEnum();
        });

        app()->bind('CalendarColorEnum', function () {
            return new CalendarColorEnum();
        });

        app()->bind(ProductService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFour();
    }
}
