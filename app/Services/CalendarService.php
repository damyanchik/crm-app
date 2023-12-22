<?php

declare(strict_types=1);

namespace App\Services;

use App\Enum\CalendarColorEnum;
use App\Models\Calendar;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CalendarService
{
    public function getCalendarData(): object
    {
        $events = Calendar::orderBy('id', 'ASC')
            ->with('user:id,name,surname')
            ->get();

        return $events->map(function ($event) {
            return $this->transformEvent($event);
        });
    }

    public function store(FormRequest $request): void
    {
        $formFields = array_merge(
            $request->validated(), [
            'user_id' => Auth::id()
        ]);

        Calendar::create($formFields);
    }

    private function transformEvent(Calendar $event): array
    {
        return [
            'id' => $event->id,
            'title' => $event->title,
            'name' => $event->user->name . ' ' . $event->user->surname,
            'description' => $event->description,
            'color' => CalendarColorEnum::getColor((int) $event->color),
            'start' => $event->date_start,
            'end' => $event->date_end,
            'user_id' => $event->user_id
        ];
    }
}
