<?php

declare(strict_types=1);

namespace App\Helpers;

use App\Models\Product;

class ProductHelper
{
    public static function getExistingByCodes(array $data): array
    {
        if (isset($data[0]['code']) || isset($data['code']))
            $codes = array_column($data, 'code');
        else
            $codes = $data;

        return Product::whereIn('code', $codes)
            ->select('code')
            ->get()
            ->toArray();
    }
}
