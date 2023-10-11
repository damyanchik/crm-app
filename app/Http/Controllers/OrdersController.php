<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\StoreOrdersItemsRequest;

class OrdersController extends Controller
{
    public function index(): object
    {
        $orders = Order::where(function($query) {
            $query->orWhere('id', 'like', '%' . request('search') . '%')
                ->orWhere('invoice_num', 'like', '%' . request('search') . '%')
                ->orWhereHas('client', function ($clientQuery) {
                    $clientQuery->where('name', 'like', '%' . request('search') . '%')
                        ->orWhere('surname', 'like', '%' . request('search') . '%')
                        ->orWhere('company', 'like', '%' . request('search') . '%');
                })
                ->orWhereHas('user', function ($userQuery) {
                    $userQuery->where('name', 'like', '%' . request('search') . '%')
                        ->orWhere('surname', 'like', '%' . request('search') . '%');
                });
        })->paginate(request('display'));

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
        $orderMonthQuant = DB::table('orders')
            ->select(DB::raw('COUNT(*) as quantity'))
            ->whereMonth('created_at', '=', date('m'))
            ->first();

        $now = now();

        return view('orders.create', [
            'orderMonthQuant' => $orderMonthQuant->quantity,
            'now' => $now
        ]);
    }

    public function store(StoreOrderRequest $orderRequest, StoreOrdersItemsRequest $ordersItemsRequest): object
    {
        DB::beginTransaction();

        try {
            $ordersForm = $orderRequest->validated();
            $ordersItemsForm = $ordersItemsRequest->validated();

            $newOrder = Order::create($ordersForm);

            foreach ($ordersItemsForm['products'] as $orderItem) {
                $orderItem['user_id'] = $ordersForm['user_id'];
                $orderItem['order_id'] = $newOrder->id;
                OrderItem::create($orderItem);
            }

            DB::commit(); // Zatwierdź transakcję po pomyślnym zakończeniu
            return redirect('/orders')->with('message', 'Utworzono zamówienie.');
        } catch (\Exception $e) {
            DB::rollBack(); // Wycofaj transakcję w przypadku błędu
            return back()->with('error', 'Wystąpił błąd podczas tworzenia zamówienia.');
        }
    }
}
