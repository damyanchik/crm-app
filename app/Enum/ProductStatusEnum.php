<?php

declare(strict_types=1);

namespace App\Enum;

class ProductStatusEnum
{
    public const AVAILABLE = ['status' => 'Dostępny', 'color' => 'success', 'id' => 0];
    public const MADE_TO_ORDER = ['status' => 'Na zamówienie', 'color' => 'warning', 'id' => 1];
    public const OUT_OF_STOCK = ['status' => 'Brak', 'color' => 'secondary', 'id' => 2];
    public const UNAVAILABLE = ['status' => 'Niedostępny', 'color' => 'danger', 'id' => 3];

    public static function getStatus(int $statusId): string
    {
        $statuses = [
            self::AVAILABLE,
            self::MADE_TO_ORDER,
            self::OUT_OF_STOCK,
            self::UNAVAILABLE,
        ];

        return $statuses[$statusId]['status'] ?? 'Nieznany';
    }

    public static function getStatusColor(int $statusId): string
    {
        $statuses = [
            self::AVAILABLE,
            self::MADE_TO_ORDER,
            self::OUT_OF_STOCK,
            self::UNAVAILABLE,
        ];

        return $statuses[$statusId]['color'] ?? '';
    }

    public static function getAllStatuses(): array
    {
        return [
            self::AVAILABLE['status'],
            self::MADE_TO_ORDER['status'],
            self::OUT_OF_STOCK['status'],
            self::UNAVAILABLE['status'],
        ];
    }
}
