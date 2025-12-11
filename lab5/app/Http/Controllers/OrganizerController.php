<?php

namespace App\Http\Controllers;

use App\Models\Organizer;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOrganizerRequest;
use App\Http\Requests\UpdateOrganizerRequest;

class OrganizerController extends Controller
{
    // Index: Преглед на сите записи со пагинација
    public function index()
    {
        $organizers = Organizer::paginate(10); // 10 записи по страница
        return view('organizers.index', compact('organizers'));
    }

    // Show: Преглед на еден запис (со неговите настани)
    public function show(Organizer $organizer)
    {
        // Користиме eager loading за да ги вчитаме настаните
        $organizer->load('events');
        return view('organizers.show', compact('organizer'));
    }

    // Create: Форма за креирање
    public function create()
    {
        return view('organizers.create');
    }

    // Store: Зачувување на нов запис (користи StoreOrganizerRequest за валидација)
    public function store(StoreOrganizerRequest $request)
    {
        Organizer::create($request->validated());
        return redirect()->route('organizers.index')
            ->with('success', 'Организаторот е успешно креиран.');
    }

    // Edit: Форма за ажурирање
    public function edit(Organizer $organizer)
    {
        return view('organizers.edit', compact('organizer'));
    }

    // Update: Ажурирање на запис (користи UpdateOrganizerRequest за валидација)
    public function update(UpdateOrganizerRequest $request, Organizer $organizer)
    {
        $organizer->update($request->validated());
        return redirect()->route('organizers.index')
            ->with('success', 'Организаторот е успешно ажуриран.');
    }

    // Destroy: Бришење на запис
    public function destroy(Organizer $organizer)
    {
        $organizer->delete(); // Поради onDelete('cascade') во миграцијата, ќе се избришат и сите негови настани
        return redirect()->route('organizers.index')
            ->with('success', 'Организаторот е успешно избришан.');
    }
}
