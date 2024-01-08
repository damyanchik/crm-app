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

    public function store(array $validatedData): void
    {
        $formFields = array_merge(
            $validatedData, [
            'user_id' => Auth::id()
        ]);

        Calendar::create($formFields);
    }

    public function destroy(Calendar $event): void
    {
        $event->delete();
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
