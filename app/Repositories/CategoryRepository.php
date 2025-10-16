<?php

namespace App\Repositories;

use App\Contracts\Repositories\CategoryRepositoryContract;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

/**
 * @method \App\Models\Category getModel()
 */
class CategoryRepository extends BaseRepository implements CategoryRepositoryContract
{

    /**
     * @param int $identifier
     *
     * @return \App\Models\Category|null
     */
    public function getOneByIdentifier(int $identifier): ?Category
    {
        return $this->getModel()
            ->newQuery()
            ->select(
                $this->getModel()->qualifyColumns(
                    [
                        'id',
                        'name',
                        'parent_id',
                    ]
                )
            )
            ->where($this->getModel()->qualifyColumn('id'), $identifier)
            ->first();
    }

    /**
     * @param int $parentID
     *
     * @return \Illuminate\Database\Eloquent\Collection<integer, Category>
     */
    public function getManyByParentIdentifier(int $parentID): Collection
    {
        return $this->getModel()
            ->newQuery()
            ->select(
                $this->getModel()->qualifyColumns(
                    [
                        'id',
                        'name',
                        'parent_id',
                    ]
                )
            )
            ->where($this->getModel()->qualifyColumn('parent_id'), $parentID)
            ->get();
    }

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