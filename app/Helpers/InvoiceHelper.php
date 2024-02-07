<?php

declare(strict_types=1);

namespace App\Helpers;

class InvoiceHelper
{
    public static function prepareInvoiceNumber(int $countedOrderInMonth): string
    {
        return $countedOrderInMonth . '/FV/' . now()->month . '/' . now()->year;
    }
}
