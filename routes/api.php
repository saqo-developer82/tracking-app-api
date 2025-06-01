<?php

use App\Http\Controllers\TrackingController;
use Illuminate\Support\Facades\Route;

Route::middleware(['cors'])->group(function () {
    Route::get('/track', [TrackingController::class, 'getInfo'])->middleware('throttle:60,1'); // 60 requests per minute
});
