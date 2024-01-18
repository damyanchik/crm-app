<?php

declare(strict_types=1);

namespace App\Factories\FileDataImporter\Processors\Traits;

trait VerifyingPriceTrait
{
    private function updatePrice(array &$item, array $existingProducts): void
    {
        if ($this->isNonPositive(floatval($item['price']))) {
            $item['price'] = $existingProducts[$item['code']]['price'];
        }

        if ($this->matchesAndGreaterThanZero($item, $existingProducts)) {
            $item['changes']['price'] = $existingProducts[$item['code']]['price'];
        }
    }

    private function isNonPositive(float $price): bool
    {
        return empty($price) && $price < 0;
    }

    private function matchesAndGreaterThanZero(array $item, array $existingProducts): bool
    {
        return $existingProducts[$item['code']]['price'] != $item['price'] && $item['price'] > 0;
    }
}
