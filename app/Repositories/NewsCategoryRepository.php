<?php

namespace App\Repositories;

use App\Contracts\Repositories\NewsCategoryRepositoryContract;
use App\Models\NewsCategory;
use Illuminate\Database\Eloquent\Collection;

/**
 * @method \App\Models\NewsCategory getModel()
 */
class NewsCategoryRepository extends BaseRepository implements NewsCategoryRepositoryContract
{

    /**
     * @param array $categoryIdentifiers
     *
     * @return \Illuminate\Database\Eloquent\Collection<integer, \App\Models\NewsCategory>
     */
    public function getManyByCategoryIdentifiers(array $categoryIdentifiers): Collection
    {
        return $this->getModel()
            ->newQuery()
            ->select(
                $this->getModel()->qualifyColumns(
                    [
                        'news_id',
                    ]
                )
            )
            ->whereIn($this->getModel()->qualifyColumn('category_id'), $categoryIdentifiers)
            ->get();
    }

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