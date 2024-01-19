<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

interface CalendarRepositoryInterface
{
    public function getOrdered(): object;
    public function store(array $data): void;
}
