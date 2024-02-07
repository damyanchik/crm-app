<?php

declare(strict_types=1);

namespace App\Helpers;

class PriceHelper
{
    public static function formatPrice(float $price): string
    {
        return number_format(
            $price,
            2,
            '.',
            ','
            ) . ' PLN';
    }
}
