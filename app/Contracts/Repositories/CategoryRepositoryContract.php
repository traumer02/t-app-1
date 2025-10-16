<?php

namespace App\Contracts\Repositories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

interface CategoryRepositoryContract
{

    /**
     * @param int $identifier
     *
     * @return \App\Models\Category|null
     */
    public function getOneByIdentifier(int $identifier): ?Category;

    /**
     * @param int $parentID
     *
     * @return \Illuminate\Database\Eloquent\Collection<integer, >
     */
    public function getManyByParentIdentifier(int $parentID): Collection;

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