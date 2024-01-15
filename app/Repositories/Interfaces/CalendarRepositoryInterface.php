<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

use App\Models\Calendar;

interface CalendarRepositoryInterface
{
    public function __construct(Calendar $model);
    public function getOrdered(): object;
    public function store(array $data): void;
}
