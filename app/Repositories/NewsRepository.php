<?php

namespace App\Repositories;

use App\Contracts\Repositories\NewsRepositoryContract;
use App\Entities\Filters\Repositories\NewsRepository\PaginateFilter;
use App\Models\News;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * @method \App\Models\News getModel()
 */
class NewsRepository extends BaseRepository implements NewsRepositoryContract
{

    /**
     * @param int                                                                   $page
     * @param int                                                                   $perPage
     * @param \App\Entities\Filters\Repositories\NewsRepository\PaginateFilter|null $filter
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginateByFilter(int $page, int $perPage, ?PaginateFilter $filter): LengthAwarePaginator
    {
        return $this->getModel()
            ->newQuery()
            ->when(!is_null($filter), fn(Builder $builder) => $filter->filter($builder))
            ->paginate(
                perPage: $perPage,
                columns: $this->getModel()
                             ->qualifyColumns(
                                 [
                                     'id',
                                     'title',
                                     'excerpt',
                                     'content',
                                     'published_at',
                                 ]
                             ),
                page:    $page,
            );
    }

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