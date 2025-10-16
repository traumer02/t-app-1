<?php

namespace App\Contracts\Services\Http\Api;

use App\Http\Requests\Api\Author\StoreRequest;
use Illuminate\Http\JsonResponse;

interface AuthorServiceContract
{

    /**
     * @param \App\Http\Requests\Api\Author\StoreRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse;
}