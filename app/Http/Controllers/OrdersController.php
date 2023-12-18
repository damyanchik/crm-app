<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\OrderService;

class OrdersController extends Controller
{
    public function __construct(protected OrderService $orderService)
    {
    }

    public function index(): object
    {
        return view('orders.index', [
            'orders' => $this->orderService->getOrders()
        ]);
    }

    public function show(Order $order): object
    {
        return view('orders.show', [
            'order' => $order,
        ]);
    }

    public function ready(Order $order): object
    {
        $this->orderService->ready($order);

        return redirect('/orders')->with(
            'message',
            'Potwierdzono gotowość zamówienia o nr '.$order->invoice_num.'.'
        );
    }

    public function close(Order $order): object
    {
        $this->orderService->close($order);

        return redirect('/orders/archive')->with(
            'message',
            'Zamknięto zamówienie o nr '.$order->invoice_num.'.'
        );
    }

    public function reject(Order $order): object
    {
        $this->orderService->reject($order);

        return redirect('/orders/archive')->with(
            'message',
            'Odrzucono zamówienie o nr '.$order->invoice_num.'.'
        );
    }
}
