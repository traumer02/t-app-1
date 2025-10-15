<?php

namespace App\Contracts\Services\Http\Api;

use App\Http\Requests\Api\Ticket\StoreRequest;
use Illuminate\Http\JsonResponse;

interface TicketServiceContract
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStatistics(): JsonResponse;

    /**
     * @param \App\Http\Requests\Api\Ticket\StoreRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse;
}