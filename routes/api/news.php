<?php


use App\Http\Controllers\NewsController;

Route::get('/', [NewsController::class, 'index']);
Route::post('/', [NewsController::class, 'store']);