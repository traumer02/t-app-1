<?php

Route::prefix('authors')
    ->namespace('authors')
    ->name('authors.')
    ->group(base_path('routes/api/authors.php'));

Route::prefix('categories')
    ->namespace('categories')
    ->name('categories.')
    ->group(base_path('routes/api/categories.php'));

Route::prefix('news')
    ->namespace('news')
    ->name('news.')
    ->group(base_path('routes/api/news.php'));