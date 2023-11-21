<?php

declare(strict_types=1);

namespace App\Enum;

class CalendarColorEnum
{
    public const NONE = '';
    public const BLACK = 'black';
    public const BLUE = 'blue';
    public const GRAY = 'gray';
    public const GREEN = 'green';
    public const ORANGE = 'orange';
    public const PINK = 'pink';
    public const PURPLE = 'purple';
    public const RED = 'red';
    public const YELLOW = 'yellow';

    public static function getColor(int $colorId): string
    {
        $colors = [
            self::NONE,
            self::BLACK,
            self::BLUE,
            self::GRAY,
            self::GREEN,
            self::ORANGE,
            self::PINK,
            self::PURPLE,
            self::RED,
            self::YELLOW,
        ];

        return $colors[$colorId] ?? 'Nieznany';
    }

    public static function getAllColors(): array
    {
        return [
            self::NONE,
            self::BLACK,
            self::BLUE,
            self::GRAY,
            self::GREEN,
            self::ORANGE,
            self::PINK,
            self::PURPLE,
            self::RED,
            self::YELLOW,
        ];
    }
}
