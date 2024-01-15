<?php

declare(strict_types=1);

namespace App\Enum;

class OrderStatusEnum
{
    public const NONE = [
        'id' => 0,
        'status' => '',
        'color' => ''
    ];
    public const OFFER = [
        'id' => 1,
        'status' => 'Oferta',
        'color' => 'info'
    ];
    public const ACCEPTED = [
        'id' => 2,
        'status' => 'Przyjęte',
        'color' => 'success'
    ];
    public const PENDING = [
        'id' => 3,
        'status' => 'Oczekiwanie',
        'color' => 'warning'
    ];
    public const READY = [
        'id' => 4,
        'status' => 'Gotowy',
        'color' => 'success'
    ];
    public const REJECTED = [
        'id' => 5,
        'status' => 'Odrzucony',
        'color' => 'danger'
    ];
    public const CLOSED = [
        'id' => 6,
        'status' => 'Zamknięte',
        'color' => 'dark'
    ];

    public const STATUSES = [
        self::NONE,
        self::OFFER,
        self::ACCEPTED,
        self::PENDING,
        self::READY,
        self::REJECTED,
        self::CLOSED
    ];

    public static function getStatus(int $statusId): string
    {
        return self::STATUSES[$statusId]['status'] ?? self::NONE['status'];
    }

    public static function getStatusColor(int $statusId): string
    {
        return self::STATUSES[$statusId]['color'] ?? self::NONE['color'];
    }

    public static function getAllStatuses(): array
    {
        return array_map(
            fn(array $val): string => $val['status'],
            self::STATUSES
        );
    }
}
