<?php

declare(strict_types=1);

namespace App\Helpers;

use App\Enum\OrderStatusEnum;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class InvoiceHelper
{
    public static function generateInvoiceNumber(): string
    {
        $invoiceNumber = self::getOrderQuantityInCurrentMonth() + 1;

        $now = now();
        $invoice = $invoiceNumber . '/FV/' . $now->month . '/' . $now->year;

        while (Order::where('invoice_num', '=', $invoice)->exists()) {
            $invoiceNumber++;
            $invoice = $invoiceNumber . '/FV/' . $now->month . '/' . $now->year;
        }

        return $invoice;
    }

    private static function getOrderQuantityInCurrentMonth(): int
    {
        $orderMonthQuantity = DB::table('orders')
            ->select(DB::raw('COUNT(*) as quantity'))
            ->whereMonth('created_at', '=', now()->month)
            ->whereIntegerNotInRaw('status', [
                OrderStatusEnum::OFFER['id'],
                OrderStatusEnum::ACCEPTED['id'],
            ])
            ->first();

        return $orderMonthQuantity->quantity;
    }
}
