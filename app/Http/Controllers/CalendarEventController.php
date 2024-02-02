<?php

namespace App\Http\Controllers;

use App\Models\CalendarEvent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CalendarEventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): View
    {
        $calendarEvents = CalendarEvent::paginate(10);
        return view('calendar.index', compact('calendarEvents'));
    }

    public function create(): View
    {
        return view('calendar.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'min:3', 'max:50'],
            'description' => ['required'],
            'start' => ['required'],
            'stop' => ['required'],
        ]);

        CalendarEvent::create([
            'name' => $request['name'],
            'stop' => $request['stop'],
            'start' => $request['start'],
            'color' => $request['color'],
            'description' => $request['description'],
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('calendar.index');
    }

    public function show(Request $request, CalendarEvent $calendarEvent): View
    {
        return view('calendar.show', compact('calendarEvent'));
    }

    public function edit(Request $request, CalendarEvent $calendarEvent): View
    {
        return view('calendar.edit', compact('calendarEvent'));
    }

    public function update(Request $request, CalendarEvent $calendarEvent): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'min:3', 'max:50'],
            'description' => ['required'],
            'start' => ['required'],
            'stop' => ['required'],
        ]);

        $calendarEvent->update([
            'name' => $request['name'],
            'stop' => $request['stop'],
            'start' => $request['start'],
            'color' => $request['color'],
            'description' => $request['description'],
        ]);

        return redirect()->route('calendar.index');
    }

    public function destroy(CalendarEvent $calendarEvent): RedirectResponse
    {
        $calendarEvent->delete();
        return redirect()->route('calendar.index');
    }
}
