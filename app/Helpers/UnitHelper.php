<?php

declare(strict_types=1);

namespace App\Helpers;

class UnitHelper
{
    private const PRODUCT_UNIT = [
        0 => 'szt.',
        1 => 'kpl.'
    ];

    public static function getProductUnit($unitId): string
    {
        return self::PRODUCT_UNIT[$unitId] ?? 'Nieznany';
    }

    public static function getAllProductUnits(): array
    {
        return self::PRODUCT_UNIT;
    }
}
