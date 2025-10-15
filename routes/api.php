<?php

Route::prefix('tickets')
    ->namespace('tickets')
    ->name('tickets.')
    ->group(base_path('routes/api/tickets.php'));