<?php

declare(strict_types=1);

namespace App\Helpers;

use App\Models\Product;

class ProductHelper
{
    public static function getExistingByCodes(array $data): array
    {
        if (in_array(['code','codes'], $data))
            $codes = array_column($data, 'code');
        else
            $codes = $data;

        return Product::whereIn('code', $codes)
            ->select('code')
            ->get()
            ->toArray();
    }
}
