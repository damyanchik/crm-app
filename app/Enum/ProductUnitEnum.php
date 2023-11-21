<?php

declare(strict_types=1);

namespace App\Enum;

class ProductUnitEnum
{
    public const PIECE = 'szt.';
    public const SET = 'kpl.';

    public static function getUnit(int $unitId): string
    {
        $units = [
            self::PIECE,
            self::SET,
        ];

        return $units[$unitId] ?? 'Nieznany';
    }

    public static function getAllUnits(): array
    {
        return [
            self::PIECE,
            self::SET,
        ];
    }
}
