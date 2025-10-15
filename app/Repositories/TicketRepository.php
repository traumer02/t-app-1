<?php

namespace App\Repositories;

use App\Contracts\Repositories\TicketRepositoryContract;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * @method \App\Models\Ticket getModel()
 */
class TicketRepository extends BaseRepository implements TicketRepositoryContract
{

    /**
     * @param \Illuminate\Support\Carbon $from
     *
     * @return int
     */
    public function getCountByCreatedAt(Carbon $from): int
    {
        return $this->getModel()
            ->newQuery()
            ->where($this->getModel()->qualifyColumn('created_at'), '>=', $from)
            ->count();
    }

    /**
     * @param \Illuminate\Support\Carbon $from
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getStatusAndCountByCreatedAt(Carbon $from): Collection
    {
        return $this->getModel()
            ->newQuery()
            ->select(
                [
                    'status',
                    DB::raw('count(*) as count'),
                ]
            )
            ->where('created_at', '>=', $from)
            ->groupBy('status')
            ->get();
    }

    /**
     * @param array $attributes
     *
     * @return \App\Models\Ticket
     */
    public function createOne(array $attributes): Ticket
    {
        return $this->getModel()
            ->newQuery()
            ->create($attributes);
    }

    /**
     * @param int                        $customerID
     * @param \Illuminate\Support\Carbon $from
     *
     * @return bool
     */
    public function existsByCustomerIdAndCreatedAtAfter(int $customerID, Carbon $from): bool
    {
        return $this->getModel()
            ->newQuery()
            ->where($this->getModel()->qualifyColumn('customer_id'), $customerID)
            ->where($this->getModel()->qualifyColumn('created_at'), '>=', $from)
            ->exists();
    }
}