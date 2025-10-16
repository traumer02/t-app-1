<?php

namespace App\Contracts\Repositories;

use App\Models\News;

interface NewsRepositoryContract
{

    /**
     * @param array $attributes
     *
     * @return \App\Models\News
     */
    public function createOne(array $attributes): News;
}