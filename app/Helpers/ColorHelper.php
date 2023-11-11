<?php

declare(strict_types=1);

namespace App\Helpers;

class ColorHelper
{
    private const COLOR = [
        1 => ['en' => 'black', 'pl' => 'Czarny'],
        2 => ['en' => 'blue', 'pl' => 'Niebieski'],
        3 => ['en' => 'gray', 'pl' => 'Szary'],
        4 => ['en' => 'green', 'pl' => 'Zielony'],
        5 => ['en' => 'orange', 'pl' => 'Pomarańczowy'],
        6 => ['en' => 'pink', 'pl' => 'Różowy'],
        7 => ['en' => 'purple', 'pl' => 'Fioletowy'],
        8 => ['en' => 'red', 'pl' => 'Czerwony'],
        9 => ['en' => 'yellow', 'pl' => 'Żółty'],
    ];

    public static function getColor($id, $lang): string
    {
        return self::COLOR[$id][$lang] ?? 'None';
    }

    public static function getAllColors(): array
    {
        return self::COLOR;
    }
}
