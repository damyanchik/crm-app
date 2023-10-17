<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Helpers\UnitHelper;
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
        $jsonUnits = json_encode(UnitHelper::getAllProductUnits());

        return view('orders.create', [
            'jsonUnits' => $jsonUnits
        ]);
    }

    public function store(StoreOrderRequest $orderRequest, StoreOrdersItemsRequest $ordersItemsRequest): object
    {
        DB::beginTransaction();

        try {
            $ordersForm = $orderRequest->validated();
            $ordersItemsForm = $ordersItemsRequest->validated();

            $ordersForm['invoice_num'] = $this->invoiceNumber();
            $newOrder = Order::create($ordersForm);

            foreach ($ordersItemsForm['products'] as $orderItem) {
                $orderItem['user_id'] = $ordersForm['user_id'];
                $orderItem['order_id'] = $newOrder->id;
                OrderItem::create($orderItem);
            }

            DB::commit();
            return redirect('/orders')->with('message', 'Utworzono zamówienie.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Wystąpił błąd podczas tworzenia zamówienia.');
        }
    }

    private function invoiceNumber(): string
    {
        $orderMonthQuant = DB::table('orders')
            ->select(DB::raw('COUNT(*) as quantity'))
            ->whereMonth('created_at', '=', date('m'))
            ->first();
        $invoiceNumber = $orderMonthQuant->quantity+1;

        $now = now();

        return $invoiceNumber.'/FV/'.$now->month.'/'.$now->year;
    }
}
