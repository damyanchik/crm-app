<?php

declare(strict_types=1);

namespace App\Enum;

class ProductUnitEnum
{
    public const NONE = '';
    public const PIECE = 'szt.';
    public const SET = 'kpl.';

    public const UNITS = [
        self::NONE,
        self::PIECE,
        self::SET,
    ];

    public static function getUnit(int $unitId): string
    {
        return self::UNITS[$unitId] ?? self::NONE;
    }

    public static function getAllUnits(): array
    {
        return self::UNITS;
    }
}
