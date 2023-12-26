<?php

declare(strict_types=1);

namespace App\Helpers;

use App\Models\Product;

class StockHelper
{
    public static function addQuantityToProductByCode(string $productCode, $quantity): void
    {
        $product = Product::where('code', $productCode)->first();

        if ($product) {
            $status = ProductStatusHelper::checkQuantityAndReturnStatus($product->quantity + $quantity);
            $product->update([
                'quantity' => $product->quantity + $quantity,
                'status' => $status
            ]);
        }
    }

    public static function takeQuantityFromProductByCode(string $productCode, $quantity): void
    {
        $product = Product::where('code', $productCode)->first();

        if ($product && $product->quantity >= $quantity) {
            $status = ProductStatusHelper::checkQuantityAndReturnStatus($product->quantity - $quantity);
            $product->update([
                'quantity' => $product->quantity - $quantity,
                'status' => $status
            ]);
        }
    }

    public static function removeAllQuantityToProducts(object $offerOrOrder): void
    {
        $orderItems = $offerOrOrder->orderItem;
        foreach ($orderItems as $item)
            self::addQuantityToProductByCode($item['code'], $item['quantity']);
    }
}
