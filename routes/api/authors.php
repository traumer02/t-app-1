<?php

use App\Http\Controllers\AuthorController;

Route::post('/', [AuthorController::class, 'store']);