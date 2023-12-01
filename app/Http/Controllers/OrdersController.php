<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enum\OrderStatusEnum;
use App\Models\Order;

class OrdersController extends Controller
{
    public function index(): object
    {
        $orders = Order::search(request('search'))
            ->where(function ($query) {
                $query->whereIn('status', [
                    OrderStatusEnum::PENDING['id'],
                    OrderStatusEnum::READY['id']
                ]);
            })
            ->sortBy(
                request('column') ?? 'id',
                request('order') ?? 'asc'
            )
            ->paginate(request('display'));

        return view('orders.index', [
            'orders' => $orders
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
        $order->setAttribute('status', OrderStatusEnum::READY['id']);
        $order->save();

        return redirect('/orders')->with(
            'Potwierdzono gotowość zamówienia o nr '.$order->invoice_num.'.'
        );
    }

    public function close(Order $order): object
    {
        $order->setAttribute('status', OrderStatusEnum::CLOSED['id']);
        $order->save();

        return redirect('/orders/archive')->with(
            'Zamknięto zamówienie o nr '.$order->invoice_num.'.'
        );
    }

    public function reject(Order $order): object
    {
        $order->setAttribute('status', OrderStatusEnum::REJECTED['id']);
        $order->save();

        return redirect('/orders/archive')->with(
            'Odrzucono zamówienie o nr '.$order->invoice_num.'.'
        );
    }
}
