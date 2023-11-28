<?php

declare(strict_types=1);

namespace App\Enum;

class OrderStatusEnum
{
    public const ACCEPTED = ['status' => 'Przyjęte', 'color' => 'secondary'];
    public const PENDING = ['status' => 'Oczekiwanie', 'color' => 'warning'];
    public const READY = ['status' => 'Gotowy', 'color' => 'success'];
    public const REJECTED = ['status' => 'Odrzucony', 'color' => 'success'];
    public const CLOSED = ['status' => 'Zamknięte', 'color' => 'dark'];

    public static function getStatus(int $statusId): string
    {
        $statuses = [
            self::ACCEPTED,
            self::PENDING,
            self::READY,
            self::REJECTED,
            self::CLOSED,
        ];

        return $statuses[$statusId]['status'] ?? 'Nieznany';
    }

    public static function getStatusColor(int $statusId): string
    {
        $statuses = [
            self::ACCEPTED,
            self::PENDING,
            self::READY,
            self::REJECTED,
            self::CLOSED,
        ];

        return $statuses[$statusId]['color'] ?? '';
    }


    public static function getAllStatuses(): array
    {
        return [
            self::ACCEPTED['status'],
            self::PENDING['status'],
            self::READY['status'],
            self::REJECTED['status'],
            self::CLOSED['status'],
        ];
    }
}
