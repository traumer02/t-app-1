<?php

namespace App\Repositories;

use App\Contracts\Repositories\AuthorRepositoryContract;
use App\Models\Author;

/**
 * @method \App\Models\Author getModel()
 */
class AuthorRepository extends BaseRepository implements AuthorRepositoryContract
{

    /**
     * @param array $attributes
     *
     * @return \App\Models\Author
     */
    public function createOne(array $attributes): Author
    {
        return $this->getModel()
            ->newQuery()
            ->create($attributes);
    }

    /**
     * @param string $email
     *
     * @return bool
     */
    public function existsByEmail(string $email): bool
    {
        return $this->getModel()
            ->newQuery()
            ->where($this->getModel()->qualifyColumn('email'), 'like', "%{$email}%")
            ->exists();
    }
}