<?php

namespace App\Http\Controllers;

use App\Contracts\Services\Http\Api\TicketServiceContract;
use App\Http\Requests\Api\Ticket\StoreRequest;
use Illuminate\Http\JsonResponse;

class TicketController extends Controller
{

    /**
     * @param \App\Contracts\Services\Http\Api\TicketServiceContract $service
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStatistics(TicketServiceContract $service)
    {
        return $service->getStatistics();
    }

    /**
     * @param \App\Http\Requests\Api\Ticket\StoreRequest             $request
     * @param \App\Contracts\Services\Http\Api\TicketServiceContract $service
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request, TicketServiceContract $service): JsonResponse
    {
        return $service->store($request);
    }

}