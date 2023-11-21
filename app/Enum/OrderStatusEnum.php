<?php

declare(strict_types=1);

namespace App\Enum;

class OrderStatusEnum
{
    public const ACCEPTED = 'Przyjęte';
    public const PENDING = 'Oczekiwanie';
    public const READY = 'Gotowy';
    public const CLOSED = 'Zamknięte';

    public static function getStatus(int $statusId): string
    {
        $statuses = [
            self::ACCEPTED,
            self::PENDING,
            self::READY,
            self::CLOSED,
        ];

        return $statuses[$statusId] ?? 'Nieznany';
    }

    public static function getAllStatuses(): array
    {
        return [
            self::ACCEPTED,
            self::PENDING,
            self::READY,
            self::CLOSED,
        ];
    }
}
