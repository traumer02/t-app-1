<?php

namespace App\Contracts\Services\Http\Api;

use App\Http\Requests\Api\Category\StoreRequest;
use Illuminate\Http\JsonResponse;

interface CategoryServiceContract
{

    /**
     * @param \App\Http\Requests\Api\Category\StoreRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse;
}