<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enum\ProductUnitEnum;
use App\Models\Order;
use App\Services\OrderService;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\StoreOrdersItemsRequest;

class OrdersController extends Controller
{
    protected OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index(): object
    {
        $orders = Order::search(request('search'))
            ->sortBy(request('column') ?? 'id', request('order') ?? 'asc')
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

    public function create(): object
    {
        $jsonUnits = json_encode(ProductUnitEnum::getAllUnits());

        return view('orders.create', [
            'jsonUnits' => $jsonUnits
        ]);
    }

    public function store(StoreOrderRequest $orderRequest, StoreOrdersItemsRequest $ordersItemsRequest): object
    {
        $this->orderService->createOrder($orderRequest, $ordersItemsRequest);

        return redirect('/orders')->with('message', 'Utworzono zamówienie.');
    }

}
