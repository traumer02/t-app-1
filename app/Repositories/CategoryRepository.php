<?php

namespace App\Repositories;

use App\Contracts\Repositories\CategoryRepositoryContract;
use App\Models\Category;

/**
 * @method \App\Models\News getModel()
 */
class CategoryRepository extends BaseRepository implements CategoryRepositoryContract
{

    /**
     * @param array $attributes
     *
     * @return \App\Models\Category
     */
    public function createOne(array $attributes): Category
    {
        return $this->getModel()
            ->newQuery()
            ->create($attributes);
    }

    public function existsBySlug(string $slug): bool
    {
        return $this->getModel()
            ->newQuery()
            ->where($this->getModel()->qualifyColumn('slug'), 'like', "%{$slug}%")
            ->exists();
    }
}