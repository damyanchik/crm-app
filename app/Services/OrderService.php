<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function createOrder(FormRequest $orderForm, FormRequest $orderItemsForm): void
    {
        DB::beginTransaction();

        try {
            $orderValidated = $orderForm->validated();
            $ordersItemsValidated = $orderItemsForm->validated();

            $orderValidated['invoice_num'] = $this->generateInvoiceNumber();
            $newOrder = Order::create($orderValidated);

            foreach ($ordersItemsValidated['products'] as $orderItem) {
                $orderItem['user_id'] = $orderValidated['user_id'];
                $orderItem['order_id'] = $newOrder->id;
                OrderItem::create($orderItem);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }

    private function generateInvoiceNumber(): string
    {
        $orderMonthQuantity = DB::table('orders')
            ->select(DB::raw('COUNT(*) as quantity'))
            ->whereMonth('created_at', '=', date('m'))
            ->first();

        $invoiceNumber = $orderMonthQuantity->quantity+1;

        $now = now();

        return $invoiceNumber.'/FV/'.$now->month.'/'.$now->year;
    }
}
