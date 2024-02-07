<?php

declare(strict_types=1);

namespace App\Factories\FileDataImporter\Processors\Traits;

trait VeryfingQuantityTrait
{
    private function updateQuantity(array &$item, array &$existingProducts): void
    {
        $existingProductQuantity = intval($existingProducts[$item['code']]['quantity']);

        if ($this->databaseValueIsPositive($existingProductQuantity)) {
            $existingProducts[$item['code']]['quantity'] = $existingProducts[$item['code']]['quantity'] - $item['quantity'];
        } else {
            $item = null;
        }

        $existingProductQuantityAfterFirstCheck = intval($existingProducts[$item['code']]['quantity']);

        if (!empty($item) && $this->databaseValueIsPositive($existingProductQuantityAfterFirstCheck)) {
            $item['changes']['quantity'] = $item['quantity'];
            $item['quantity'] = $item['quantity'] + $existingProducts[$item['code']]['quantity'];
            $existingProducts[$item['code']]['quantity'] = 0;
        }
    }

    private function databaseValueIsPositive(int $existingProducts): bool
    {
        return $existingProducts > 0;
    }
}
