<?php

declare(strict_types=1);

namespace App\Enum;

class ProductStatusEnum
{
    public const NONE = ['status' => '', 'color' => '', 'id' => 0];
    public const AVAILABLE = ['status' => 'Dostępny', 'color' => 'success', 'id' => 1];
    public const MADE_TO_ORDER = ['status' => 'Na zamówienie', 'color' => 'warning', 'id' => 2];
    public const OUT_OF_STOCK = ['status' => 'Brak', 'color' => 'secondary', 'id' => 3];
    public const UNAVAILABLE = ['status' => 'Niedostępny', 'color' => 'danger', 'id' => 4];

    private const STATUSES = [
        self::NONE,
        self::AVAILABLE,
        self::MADE_TO_ORDER,
        self::OUT_OF_STOCK,
        self::UNAVAILABLE,
    ];

    public static function getStatus(int $statusId): string
    {
        return self::STATUSES[$statusId]['status'] ?? self::NONE[0]['status'];
    }

    public static function getStatusColor(int $statusId): string
    {
        return self::STATUSES[$statusId]['color'] ?? self::NONE[0]['color'];
    }

    public static function getAllStatuses(): array
    {
        return array_map(
            fn(array $val): string => $val['status'],
            self::STATUSES
        );
    }

    public static function verifyProductsAndSetStatus(array &$products): void
    {
        foreach ($products as &$item) {
            $item['status'] = self::verifyQuantityAndGetStatus($item['quantity']);
        }
    }

    public static function verifyQuantityAndGetStatus(int $quantity): int
    {
        if ($quantity > 0) {
            return ProductStatusEnum::AVAILABLE['id'];
        } else {
            return ProductStatusEnum::OUT_OF_STOCK['id'];
        }
    }
}
