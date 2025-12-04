<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrganizerController; // <-- ОВОЈ РЕД НЕДОСТИГА ИЛИ Е ПОГРЕШЕН
use App\Http\Controllers\EventController;

Route::get('/', function () {
    return redirect()->route('organizers.index');
});

// CRUD рути за Организатори
Route::resource('organizers', OrganizerController::class);

// CRUD рути за Настани
Route::resource('events', EventController::class);
