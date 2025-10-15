<?php

use App\Http\Controllers\TicketController;

Route::get('statistics', [TicketController::class, 'getStatistics']);
Route::post('/', [TicketController::class, 'store']);