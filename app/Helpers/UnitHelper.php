<?php

declare(strict_types=1);

namespace App\Helpers;

class UnitHelper
{
    const UNIT = [
        0 => 'szt.',
        1 => 'kpl.'
    ];

    public static function getProductUnit($unitId): string
    {
        return self::UNIT[$unitId] ?? 'Nieznany';
    }
}
