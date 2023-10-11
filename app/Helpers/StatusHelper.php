<?php

declare(strict_types=1);

namespace App\Helpers;

class StatusHelper
{
    const STATUS = [
        0 => 'Przyjęte',
        1 => 'Oczekiwanie',
        2 => 'Gotowy',
        3 => 'Zamknięte'
    ];

    public static function getOrderStatus($statusId): string
    {
        return self::STATUS[$statusId] ?? 'Nieznany';
    }
}
