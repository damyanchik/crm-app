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
            $product->update(['quantity' => $product->quantity + $quantity]);
        } else {
            throw new \Exception('Nie odnaleziono produktu.');
        }
    }

    public static function takeQuantityFromProductByCode(string $productCode, $quantity): void
    {
        $product = Product::where('code', $productCode)->first();

        if ($product && $product->quantity >= $quantity) {
            $product->update(['quantity' => $product->quantity - $quantity]);
        } elseif (!$product) {
            throw new \Exception('Nie odnaleziono produktu.');
        } else {
            throw new \Exception('Niewystarczająca ilość produktu.');
        }
    }

    public static function removeAllQuantityToProducts(object|array $offerOrOrder): void
    {
        $orderItems = $offerOrOrder->orderItem ?? $offerOrOrder;
        foreach ($orderItems as $item)
            self::addQuantityToProductByCode($item['code'], $item['quantity']);
    }
}
