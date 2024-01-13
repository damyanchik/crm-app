<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Enum\CalendarColorEnum;
use App\Models\Calendar;
use Illuminate\Support\Facades\Auth;

class CalendarRepository extends BaseRepository
{
    public function __construct(Calendar $model)
    {
        parent::__construct($model);
    }

    public function getOrdered(): object
    {
        $events = Calendar::orderBy('id', 'ASC')
            ->with('user:id,name,surname')
            ->get();

        return $events->map(function ($event) {
            return $this->transformEvent($event);
        });
    }

    public function store(array $data): void
    {
        $data['user_id'] = Auth::id();

        parent::store($data);
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
