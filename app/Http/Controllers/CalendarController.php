<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Calendar;
use App\Http\Requests\StoreCalendarRequest;
use App\Services\CalendarService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CalendarController extends Controller
{
    public function __construct(protected CalendarService $calendarService)
    {
    }

    public function index(): View
    {
        return view('calendar.index', [
            'events' => $this->calendarService->getCalendarData()
        ]);
    }

    public function store(StoreCalendarRequest $calendarStoreRequest): RedirectResponse
    {
        try {
            $this->calendarService->store($calendarStoreRequest);
            return redirect()->route('calendar')->with('message', 'Utworzono wydarzenie w kalendarzu.');
        } catch (\Exception $e) {
            return back()->with('message', 'Nastąpił błąd w trakcie zapisu.');
        }
    }

    public function destroy(Calendar $event): RedirectResponse
    {
        try {
            $this->calendarService->destroy($event);
            return redirect()->route('calendar')->with('message', 'Usunięto wydarzenie w kalendarzu.');
        } catch (\Exception $e) {
            return back()->with('message', 'Nastąpił błąd w trakcie usuniecia.');
        }
    }
}
