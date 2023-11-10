<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Calendar;
use App\Http\Requests\CalendarStoreRequest;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    public function index()
    {
        $events = Calendar::orderBy('id', 'ASC')
            ->select('date_start as start', 'date_end as end', 'title')
            ->get();

        return view('calendar.index', [
            'events' => $events
        ]);
    }

    public function store(CalendarStoreRequest $request)
    {
        $formFields = $request->validated();
        $formFields['user_id'] = Auth::id();

        Calendar::create($formFields);

        return redirect('/calendar')->with('message', 'Utworzono wydarzenie w kalendarzu.');
    }
}
