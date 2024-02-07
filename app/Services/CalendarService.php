<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Calendar;
use App\Repositories\CalendarRepository;

class CalendarService
{
    public function __construct(protected CalendarRepository $calendarRepository)
    {
    }

    public function getCalendarData(): object
    {
        return $this->calendarRepository->getOrdered();
    }

    public function store(array $validatedData): void
    {
        $this->calendarRepository->store($validatedData);
    }

    public function destroy(Calendar $event): void
    {
        $this->calendarRepository->destroy($event);
    }
}
