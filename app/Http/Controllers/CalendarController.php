<?php

namespace App\Http\Controllers;

use App\Services\CalendarService;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function __construct(
        private readonly CalendarService $calendarService,
    ) {}

    public function index(Request $request)
    {
        $user = $this->authenticatedUser($request);
        $events = $this->calendarService->getScheduledEventsForUser($user);

        return view('calendar', compact('events', 'user'));
    }

    public function events(Request $request)
    {
        $user = $this->authenticatedUser($request);
        $events = $this->calendarService->getScheduledEventsForUser($user);

        return response()->json($events);
    }
}
