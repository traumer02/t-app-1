<?php

namespace App\Entities\Filters\Repositories\NewsRepository;

use App\Entities\Abstract\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Stringable;

class PaginateFilter extends AbstractFilter
{

    protected array $ids=[];

    protected Stringable $title;

    protected int $authorId;

    /**
     * @param Builder $builder
     *
     * @return Builder
     */
    public function filter(Builder $builder): Builder
    {
        return $builder
            ->when(
                !empty($this->ids),
                fn (Builder $query): Builder => $query->whereIn(
                    $builder->qualifyColumn('id'), $this->ids
                )
            )
            ->when(
                filled($this->title),
                fn(Builder $query): Builder => $query->where(
                    $builder->qualifyColumn('title'), 'like', "%{$this->title}%"
                )
            )
            ->when(
                $this->authorId !== 0,
                fn(Builder $query): Builder => $query->where(
                    $builder->qualifyColumn('author_id'),
                    $this->authorId
                )
            );
    }
}
