
<?php

use App\Http\Controllers\weatherController;
use Illuminate\Support\Facades\Route;

Route::get('/weather/{location}',[weatherController::class,'show'])->name('weather.show');