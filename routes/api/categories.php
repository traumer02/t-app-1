<?php

use App\Http\Controllers\CategoryController;

Route::post('/', [CategoryController::class, 'store']);