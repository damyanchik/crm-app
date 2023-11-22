<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Calendar;
use App\Http\Requests\CalendarStoreRequest;
use Illuminate\Support\Facades\Auth;
use App\Enum\CalendarColorEnum;

class CalendarController extends Controller
{
    public function index(): object
    {
        $events = Calendar::orderBy('id', 'ASC')
            ->with('user:id,name,surname')
            ->get();

        $transformedEvents = $events->map(function ($event) {
            return $this->transformEvent($event);
        });

        return view('calendar.index', [
            'events' => $transformedEvents
        ]);
    }

    public function store(CalendarStoreRequest $request): object
    {
        $formFields = array_merge(
            $request->validated(), [
                'user_id' => Auth::id()
            ]);

        Calendar::create($formFields);

        return redirect('/calendar')->with('message', 'Utworzono wydarzenie w kalendarzu.');
    }

    public function destroy(Calendar $event): object
    {
        $event->delete();

        return redirect('/calendar')->with('message', 'Wydarzenie z kalendarza zostało usunięte.');
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
