<?php

namespace App\Contracts\Repositories;

use App\Models\Author;

interface AuthorRepositoryContract
{

    /**
     * @param array $attributes
     *
     * @return \App\Models\Author
     */
    public function createOne(array $attributes): Author;

    /**
     * @param string $email
     *
     * @return bool
     */
    public function existsByEmail(string $email): bool;
}