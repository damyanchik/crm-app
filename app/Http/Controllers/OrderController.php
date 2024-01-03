<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\IndexRequest;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function __construct(protected OrderService $orderService)
    {
    }

    public function index(IndexRequest $indexRequest): View
    {
        return view('orders.index', [
            'orders' => $this->orderService->getAll($indexRequest)
        ]);
    }

    public function show(Order $order): View
    {
        return view('orders.show', [
            'order' => $order,
        ]);
    }

    public function ready(Order $order): RedirectResponse
    {
        try {
            $this->orderService->ready($order);
            return redirect()->route('orders')->with(
                'message',
                'Potwierdzono gotowość zamówienia o nr '.$order->invoice_num.'.'
            );
        } catch (\Exception $e) {
            return redirect()->route('orders')->with('message', 'Wystąpił błąd w trakcie zapisu.');
        }
    }

    public function close(Order $order): RedirectResponse
    {
        try {
            $this->orderService->close($order);
            return redirect('/orders/archive')->route('orderArchives')->with(
                'message',
                'Zamknięto zamówienie o nr '.$order->invoice_num.'.'
            );
        } catch (\Exception $e) {
            return redirect()->route('orders')->with('message', 'Wystąpił błąd w trakcie zapisu.');
        }
    }

    public function reject(Order $order): RedirectResponse
    {
        try {
            $this->orderService->reject($order);
            return redirect('/orders/archive')->with(
                'message',
                'Odrzucono zamówienie o nr '.$order->invoice_num.'.'
            );
        } catch (\Exception $e) {
            return redirect()->route('orders')->with('message', 'Wystąpił błąd w trakcie zapisu.');
        }
    }
}
