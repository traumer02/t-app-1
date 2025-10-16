<?php

namespace App\Contracts\Repositories;

use App\Models\NewsCategory;
use Illuminate\Database\Eloquent\Collection;

interface NewsCategoryRepositoryContract
{

    /**
     * @param array $categoryIdentifiers
     *
     * @return \Illuminate\Database\Eloquent\Collection<integer, \App\Models\NewsCategory>
     */
    public function getManyByCategoryIdentifiers(array $categoryIdentifiers): Collection;

    /**
     * @param array $attributes
     *
     * @return \App\Models\NewsCategory
     */
    public function createOne(array $attributes): NewsCategory;
}