<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enum\OrderStatusEnum;
use App\Models\Order;

class ArchiveController extends Controller
{
    public function index(): object
    {
        $orders = Order::search(request('search'))
            ->where(function ($query) {
                $query->whereIn('status', [
                    OrderStatusEnum::REJECTED['id'],
                    OrderStatusEnum::CLOSED['id'],
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
}
