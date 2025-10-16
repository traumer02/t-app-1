<?php

use App\Contracts;
use App\Models;
use App\Repositories;
use App\Services;

return [
    'repositories' => [
        Contracts\Repositories\AuthorRepositoryContract::class                => [
            'repository' => Repositories\AuthorRepository::class,
            'model'      => Models\Author::class,
        ],
        Contracts\Repositories\CategoryRepositoryContract::class                => [
            'repository' => Repositories\CategoryRepository::class,
            'model'      => Models\Category::class,
        ],
        Contracts\Repositories\NewsRepositoryContract::class                => [
            'repository' => Repositories\NewsRepository::class,
            'model'      => Models\News::class,
        ],
        Contracts\Repositories\NewsCategoryRepositoryContract::class                => [
            'repository' => Repositories\NewsCategoryRepository::class,
            'model'      => Models\NewsCategory::class,
        ],
    ],

    'services' => [
        Contracts\Services\Http\Api\AuthorServiceContract::class =>
            Services\Http\Api\AuthorService::class,
        Contracts\Services\Http\Api\CategoryServiceContract::class =>
            Services\Http\Api\CategoryService::class,
        Contracts\Services\Http\Api\NewsServiceContract::class =>
            Services\Http\Api\NewsService::class,
    ]
];