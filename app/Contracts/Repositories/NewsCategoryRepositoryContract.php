<?php

namespace App\Contracts\Repositories;

use App\Models\NewsCategory;

interface NewsCategoryRepositoryContract
{

    /**
     * @param array $attributes
     *
     * @return \App\Models\NewsCategory
     */
    public function createOne(array $attributes): NewsCategory;
}