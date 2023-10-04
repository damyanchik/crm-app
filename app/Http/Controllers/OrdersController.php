<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    public function index()
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

    public function create()
    {
        $orderMontQuant = DB::table('orders')
            ->select(DB::raw('COUNT(*) as quantity'))
            ->whereMonth('created_at', '=', date('m'))
            ->first();

        $now = now();

        return view('orders.create', [
            'orderMontQuant' => $orderMontQuant->quantity,
            'now' => $now
        ]);
    }

    public function store(Request $request)
    {

        $ordersForm = $request->validate([
            'user_id' => 'required',
            'client_id' => 'required',
            'status' => 'required',
            'invoice_num' => 'required',
            'total_quantity' => 'required',
            'total_price' => 'required'
        ]);

        $ordersItemsForm = $request->validate([
            'products.*.name' => 'required',
            'products.*.brand' => 'required',
            'products.*.unit' => 'required',
            'products.*.quantity' => 'required',
            'products.*.price' => 'required'
        ]);

        $newOrder = Order::create($ordersForm);

        foreach ($ordersItemsForm['products'] as $orderItem) {
            $orderItem['user_id'] = $ordersForm['user_id'];
            $orderItem['order_id'] = $newOrder->id;
            OrderItem::create($orderItem);
        }

        return redirect('/orders')->with('message', 'Utworzono zamówienie.');
    }
}
