<?php

namespace App\Repositories;

use App\Contracts\Repositories\NewsRepositoryContract;
use App\Models\News;

/**
 * @method \App\Models\News getModel()
 */
class NewsRepository extends BaseRepository implements NewsRepositoryContract
{

    /**
     * @param array $attributes
     *
     * @return \App\Models\News
     */
    public function createOne(array $attributes): News
    {
        return $this->getModel()
            ->newQuery()
            ->create($attributes);
    }
}