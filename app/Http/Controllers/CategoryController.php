<?php

namespace App\Http\Controllers;

use App\Contracts\Services\Http\Api\CategoryServiceContract;
use App\Http\Requests\Api\Category\StoreRequest;

class CategoryController
{

    /**
     * @param \App\Http\Requests\Api\Category\StoreRequest             $request
     * @param \App\Contracts\Services\Http\Api\CategoryServiceContract $service
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request, CategoryServiceContract $service)
    {
        return $service->store($request);
    }
}