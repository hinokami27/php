<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Organizer;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     * Преглед на сите настани со пагинација.
     */
    public function index()
    {
        // Користиме eager loading за да го вчитаме организаторот за секој настан
        $events = Event::with('organizer')->paginate(2);
        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     * Форма за креирање на нов настан.
     */
    public function create()
    {
        // Потребно ни е листа со сите организатори за dropdown менито
        $organizers = Organizer::all(['id', 'full_name']);
        return view('events.create', compact('organizers'));
    }

    /**
     * Store a newly created resource in storage.
     * Зачувување на нов настан со валидација.
     */
    public function store(StoreEventRequest $request)
    {
        Event::create($request->validated());

        return redirect()->route('events.index')
            ->with('success', 'Настанот е успешно креиран.');
    }

    /**
     * Display the specified resource.
     * Преглед на еден настан.
     */
    public function show(Event $event)
    {
        // Осигуруваме дека организаторот е вчитан
        $event->load('organizer');
        return view('events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     * Форма за ажурирање на постоечки настан.
     */
    public function edit(Event $event)
    {
        $organizers = Organizer::all(['id', 'full_name']);
        return view('events.edit', compact('event', 'organizers'));
    }

    /**
     * Update the specified resource in storage.
     * Ажурирање на запис во базата со валидација.
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        $event->update($request->validated());

        return redirect()->route('events.index')
            ->with('success', 'Настанот е успешно ажуриран.');
    }

    /**
     * Remove the specified resource from storage.
     * Бришење на запис.
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events.index')
            ->with('success', 'Настанот е успешно избришан.');
    }
}
