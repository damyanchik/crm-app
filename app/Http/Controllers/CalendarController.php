<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Calendar;
use App\Http\Requests\CalendarStoreRequest;
use App\Services\CalendarService;
use Illuminate\Support\Facades\Auth;
use App\Enum\CalendarColorEnum;

class CalendarController extends Controller
{
    public function __construct(protected CalendarService $calendarService)
    {
    }

    public function index(): object
    {
        return view('calendar.index', [
            'events' => $this->calendarService->getCalendarData()
        ]);
    }

    public function store(CalendarStoreRequest $request): object
    {
        $this->calendarService->store($request);

        return redirect('/calendar')->with('message', 'Utworzono wydarzenie w kalendarzu.');
    }

    public function destroy(Calendar $event): object
    {
        $event->delete();

        return redirect('/calendar')->with('message', 'Wydarzenie z kalendarza zostało usunięte.');
    }
}
