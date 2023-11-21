<?php

declare(strict_types=1);

namespace App\Enum;

class ProductStatusEnum
{
    public const AVAILABLE = 'Dostępny';
    public const MADE_TO_ORDER = 'Na zamówienie';
    public const OUT_OF_STOCK = 'Brak';
    public const UNAVAILABLE = 'Niedostępny';

    public static function getStatus(int $statusId): string
    {
        $statuses = [
            self::AVAILABLE,
            self::MADE_TO_ORDER,
            self::OUT_OF_STOCK,
            self::UNAVAILABLE,
        ];

        return $statuses[$statusId] ?? 'Nieznany';
    }

    public static function getAllStatuses(): array
    {
        return [
            self::AVAILABLE,
            self::MADE_TO_ORDER,
            self::OUT_OF_STOCK,
            self::UNAVAILABLE,
        ];
    }
}
