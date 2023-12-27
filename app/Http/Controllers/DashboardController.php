<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\CalendarService;
use App\Services\DashboardService;

class DashboardController extends Controller
{
    public function __construct(
        protected DashboardService $dashboardService,
        protected CalendarService $calendarService
    )
    {
    }

    public function index(): object
    {
        return view('dashboard.index', [
            'dashboardData' => $this->dashboardService->getDashboardData(),
            'events' => $this->calendarService->getCalendarData()
        ]);
    }
}
