<?php

// routes/web.php

use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;


Route::resource('services', ServiceController::class);

// Дополнително, пренасочете ја основната рута '/' кон index страницата
Route::get('/', [ServiceController::class, 'index']);
