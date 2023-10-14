<?php

declare(strict_types=1);

namespace App\Helpers;

class StatusHelper
{
    private const ORDER_STATUS = [
        0 => 'Przyjęte',
        1 => 'Oczekiwanie',
        2 => 'Gotowy',
        3 => 'Zamknięte'
    ];

    private const PRODUCT_STATUS = [
        0 => 'Dostępny',
        1 => 'Na zamówienie',
        2 => 'Brak',
        3 => 'Niedostępny'
    ];

    public static function getOrderStatus($statusId): string
    {
        return self::ORDER_STATUS[$statusId] ?? 'Nieznany';
    }

    public static function getAllOrderStatuses(): array
    {
        return self::ORDER_STATUS;
    }

    public static function getProductStatus($statusId): string
    {
        return self::PRODUCT_STATUS[$statusId] ?? 'Nieznany';
    }

    public static function getAllProductStatuses(): array
    {
        return self::PRODUCT_STATUS;
    }
}
