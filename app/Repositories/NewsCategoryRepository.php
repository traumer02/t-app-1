<?php

namespace App\Repositories;

use App\Contracts\Repositories\NewsCategoryRepositoryContract;
use App\Models\NewsCategory;

/**
 * @method \App\Models\NewsCategory getModel()
 */
class NewsCategoryRepository extends BaseRepository implements NewsCategoryRepositoryContract
{

    /**
     * @param array $attributes
     *
     * @return \App\Models\NewsCategory
     */
    public function createOne(array $attributes): NewsCategory
    {
        return $this->getModel()
            ->newQuery()
            ->create($attributes);
    }
}