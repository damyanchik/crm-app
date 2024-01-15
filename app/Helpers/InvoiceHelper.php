<?php

declare(strict_types=1);

namespace App\Helpers;

class InvoiceHelper
{
    public static function prepareInvoiceNumber(int $invoiceNumber): string
    {
        return $invoiceNumber . '/FV/' . now()->month . '/' . now()->year;
    }
}
