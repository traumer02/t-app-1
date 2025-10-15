<?php

namespace App\Services\Http\Api;

use App\Contracts\Services\Http\Api\TicketServiceContract;
use App\Enums\Models\Status;
use App\Facades\Repository;
use App\Http\Requests\Api\Ticket\StoreRequest;
use App\Http\Resources\GetStatisticsResource;
use App\Services\BaseHttpService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;

class TicketService extends BaseHttpService implements TicketServiceContract
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStatistics(): JsonResponse
    {
        $now = Carbon::now();

        $ranges = [
            'day'   => $now->copy()->subDay(),
            'week'  => $now->copy()->subWeek(),
            'month' => $now->copy()->subMonth(),
        ];

        $generatedAt = $now->toISOString();
        $totals      = collect();
        $byStatuses  = collect();

        foreach ($ranges as $key => $from) {
            $total = Repository::ticket()->getCountByCreatedAt($from);

            $byStatus         = Repository::ticket()->getStatusAndCountByCreatedAt($from)->keyBy('status');
            $totals[$key]     = $total;
            $byStatuses[$key] = $byStatus;
        }

        return $this->response->data(
            (new GetStatisticsResource(
                collect(
                    compact(
                        'generatedAt',
                        'totals',
                        'byStatuses',
                    )
                )
            ))
        )->ok();
    }

    /**
     * @param \App\Http\Requests\Api\Ticket\StoreRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $customerID = $request->safe()->integer('customer_id');
        $subject    = $request->safe()->string('subject');
        $text       = $request->safe()->string('text');
        $from       = now()->subDay();

        $ticket = Repository::ticket()->existsByCustomerIdAndCreatedAtAfter($customerID, $from);

        if ($ticket) {
            return $this->response
                ->message('You have increased the ticket creation limit for today.')
                ->fail();
        }

        Repository::ticket()->createOne(
            [
                'customer_id' => $customerID,
                'subject'     => $subject,
                'text'        => $text,
                'status'      => Status::New,
            ]
        );

        return $this->response->created()->ok();
    }
}