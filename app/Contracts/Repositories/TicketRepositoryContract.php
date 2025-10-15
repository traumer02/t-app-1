<?php

namespace App\Contracts\Repositories;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

interface TicketRepositoryContract
{

    /**
     * @param \Illuminate\Support\Carbon $from
     *
     * @return int
     */
    public function getCountByCreatedAt(Carbon $from): int;

    /**
     * @param \Illuminate\Support\Carbon $from
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getStatusAndCountByCreatedAt(Carbon $from): Collection;

    /**
     * @param array $attributes
     *
     * @return \App\Models\Ticket
     */
    public function createOne(array $attributes): Ticket;

    /**
     * @param int                        $customerID
     * @param \Illuminate\Support\Carbon $from
     *
     * @return bool
     */
    public function existsByCustomerIdAndCreatedAtAfter(int $customerID, Carbon $from): bool;
}