<?php

declare(strict_types=1);

namespace App\Helpers;

use App\Enum\ProductStatusEnum;

class ProductStatusHelper
{
    public static function checkAllQuantityAndSet(array &$products): void
    {
        foreach ($products as &$item) {
            if ($item['quantity'] > 0) {
                $item['status'] = ProductStatusEnum::AVAILABLE['id'];
            } else {
                $item['status'] = ProductStatusEnum::OUT_OF_STOCK['id'];
            }
        }
    }

    public static function checkSingleQuantityAndSet(array|object $product): int
    {
        $quantity = $product->quantity ?? $product['quantity'];

        return self::verifyStatus($quantity);
    }

    public static function checkQuantityAndReturnStatus(int $quantity): int
    {
        return self::verifyStatus($quantity);
    }

    private static function verifyStatus(int $quantity): int
    {
        if ($quantity > 0) {
            $status = ProductStatusEnum::AVAILABLE['id'];
        } else {
            $status = ProductStatusEnum::OUT_OF_STOCK['id'];
        }

        return $status;
    }
}
