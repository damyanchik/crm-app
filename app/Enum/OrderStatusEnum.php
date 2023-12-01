<?php

declare(strict_types=1);

namespace App\Enum;

class OrderStatusEnum
{
    public const OFFER = [
        'id' => 0,
        'status' => 'Oferta',
        'color' => 'info'
    ];
    public const ACCEPTED = [
        'id' => 1,
        'status' => 'Przyjęte',
        'color' => 'success'
    ];
    public const PENDING = [
        'id' => 2,
        'status' => 'Oczekiwanie',
        'color' => 'warning'
    ];
    public const READY = [
        'id' => 3,
        'status' => 'Gotowy',
        'color' => 'success'
    ];
    public const REJECTED = [
        'id' => 4,
        'status' => 'Odrzucony',
        'color' => 'danger'
    ];
    public const CLOSED = [
        'id' => 5,
        'status' => 'Zamknięte',
        'color' => 'dark'
    ];

    public const STATUSES = [
        self::OFFER,
        self::ACCEPTED,
        self::PENDING,
        self::READY,
        self::REJECTED,
        self::CLOSED
    ];

    public static function getStatus(int $statusId): string
    {
        return self::STATUSES[$statusId]['status'] ?? 'Nieznany';
    }

    public static function getStatusColor(int $statusId): string
    {
        return self::STATUSES[$statusId]['color'] ?? '';
    }

    public static function getAllStatuses(): array
    {
        return [
            self::OFFER['status'],
            self::ACCEPTED['status'],
            self::PENDING['status'],
            self::READY['status'],
            self::REJECTED['status'],
            self::CLOSED['status'],
        ];
    }
}
