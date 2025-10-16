<?php

namespace App\Contracts\Repositories;

use App\Models\Category;

interface CategoryRepositoryContract
{

    /**
     * @param array $attributes
     *
     * @return \App\Models\Category
     */
    public function createOne(array $attributes): Category;

    /**
     * @param string $slug
     *
     * @return bool
     */
    public function existsBySlug(string $slug): bool;
}