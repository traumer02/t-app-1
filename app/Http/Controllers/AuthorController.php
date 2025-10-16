<?php

namespace App\Http\Controllers;

use App\Contracts\Services\Http\Api\AuthorServiceContract;
use App\Http\Requests\Api\Author\StoreRequest;

class AuthorController
{

    /**
     * @param \App\Http\Requests\Api\Author\StoreRequest             $request
     * @param \App\Contracts\Services\Http\Api\AuthorServiceContract $service
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request, AuthorServiceContract $service)
    {
        return $service->store($request);
    }
}