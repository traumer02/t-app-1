<?php

namespace App\Contracts\Repositories;

use App\Entities\Filters\Repositories\NewsRepository\PaginateFilter;
use App\Models\News;
use Illuminate\Pagination\LengthAwarePaginator;

interface NewsRepositoryContract
{

    /**
     * @param int                                                                   $page
     * @param int                                                                   $perPage
     * @param \App\Entities\Filters\Repositories\NewsRepository\PaginateFilter|null $filter
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginateByFilter(int $page, int $perPage, ?PaginateFilter $filter): LengthAwarePaginator;

    /**
     * @param array $attributes
     *
     * @return \App\Models\News
     */
    public function createOne(array $attributes): News;
}