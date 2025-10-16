<?php

use App\Contracts;
use App\Models;
use App\Repositories;
use App\Services;

return [
    'repositories' => [
        Contracts\Repositories\TicketRepositoryContract::class                => [
            'repository' => Repositories\TicketRepository::class,
            'model'      => Models\News::class,
        ],
    ],

    'services' => [
        Contracts\Services\Http\Api\TicketServiceContract::class =>
            Services\Http\Api\TicketService::class,
    ]
];