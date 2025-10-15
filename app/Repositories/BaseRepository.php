<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Base abstract repository.
 */
abstract class BaseRepository
{

    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    private Model $model;

    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function getModel(): Model
    {
        return $this->model;
    }
}
