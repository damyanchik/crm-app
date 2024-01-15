<?php

namespace App\Providers;

use App\Events\StockToOrder;
use App\Events\OrderToStock;
use App\Listeners\OrderToStockHandler;
use App\Listeners\StockToOrderHandler;
use App\Models\Order;
use App\Models\OrderItem;
use App\Observers\OrderItemObserver;
use App\Observers\OrderObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Auth\Events\Login;
use App\Events\UserLogging;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        Login::class => [
            UserLogging::class,
        ],
        StockToOrder::class => [
            StockToOrderHandler::class
        ],
        OrderToStock::class => [
            OrderToStockHandler::class
        ]
    ];

    protected $observers = [
        OrderItem::class => [OrderItemObserver::class],
        Order::class => [OrderObserver::class]
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
