<?php

namespace App\Facades;

use App\Contracts\Repositories;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Str;

/**
 * @method static Repositories\AuthorRepositoryContract author()
 * @method static Repositories\CategoryRepositoryContract category()
 * @method static Repositories\NewsRepositoryContract news()
 * @method static Repositories\NewsRepositoryContract newsCategory()
 */
class Repository extends Facade
{

    /**
     * @inheritDoc
     */
    public static function __callStatic($method, $args)
    {
        $repositoryInterfaceName = sprintf(
            "App\\Contracts\\Repositories\\%sRepositoryContract",
            Str::ucfirst($method)
        );

        if (interface_exists($repositoryInterfaceName)) {
            return app($repositoryInterfaceName);
        }

        return null;
    }
}
