<?php

namespace App\Facades;

use App\Contracts\Repositories;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Str;

/**
 * @method static Repositories\TicketRepositoryContract ticket()
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
