<?php

// app/Http/Controllers/ServiceController.php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Приказ на сите сервисирања (Read - Index).
     */
    public function index()
    {
        $services = Service::latest()->paginate(10);
        return view('services.index', compact('services'));
    }

    /**
     * Приказ на формата за додавање ново сервисирање (Create - Form).
     */
    public function create()
    {
        return view('services.create');
    }

    /**
     * Зачувување на ново сервисирање (Create - Store).
     */
    public function store(Request $request)
    {
        // Валидација
        $request->validate([
            'mechanic_name' => 'required|string|max:255',
            'client_name' => 'required|string|max:255',
            'vehicle_make' => 'required|string|max:100',
            'vehicle_model' => 'required|string|max:100',
            'license_plate' => 'required|string|max:20|unique:services,license_plate',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'date_received' => 'required|date',
            'date_completed' => 'nullable|date|after_or_equal:date_received',
        ]);

        Service::create($request->all());

        return redirect()->route('services.index')
            ->with('success', 'Сервисирањето е успешно додадено.');
    }

    /**
     * Приказ на формата за ажурирање на сервисирање (Update - Edit).
     */
    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    /**
     * Ажурирање на постоечко сервисирање (Update - Update).
     */
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'mechanic_name' => 'required|string|max:255',
            'client_name' => 'required|string|max:255',
            'vehicle_make' => 'required|string|max:100',
            'vehicle_model' => 'required|string|max:100',
            'license_plate' => 'required|string|max:20|unique:services,license_plate,' . $service->id,
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'date_received' => 'required|date',
            'date_completed' => 'nullable|date|after_or_equal:date_received',
        ]);

        $service->update($request->all());

        return redirect()->route('services.index')
            ->with('success', 'Сервисирањето е успешно ажурирано.');
    }

    /**
     * Бришење на сервисирање (Delete - Destroy).
     */
    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('services.index')
            ->with('success', 'Сервисирањето е успешно избришано.');
    }

}
