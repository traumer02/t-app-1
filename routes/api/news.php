<?php


use App\Http\Controllers\NewsController;

Route::post('/', [NewsController::class, 'store']);