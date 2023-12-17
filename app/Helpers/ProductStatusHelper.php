<?php

declare(strict_types=1);

namespace App\Helpers;

use App\Enum\ProductStatusEnum;

class ProductStatusHelper
{
    public static function checkQuantityAndSetStatus(array $products): array
    {
        foreach ($products as $item) {
            if ($item['quantity'] > 0)
                $item['status'] = ProductStatusEnum::AVAILABLE['id'];
            else
                $item['status'] = ProductStatusEnum::OUT_OF_STOCK['id'];
        }

        return $products;
    }
}
