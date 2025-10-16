<?php

namespace App\Http\Controllers;

use App\Contracts\Services\Http\Api\NewsServiceContract;
use App\Http\Requests\Api\News\IndexRequest;
use App\Http\Requests\Api\News\StoreRequest;
use Illuminate\Http\JsonResponse;

class NewsController
{

    /**
     * @param \App\Http\Requests\Api\News\IndexRequest             $request
     * @param \App\Contracts\Services\Http\Api\NewsServiceContract $service
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(IndexRequest $request, NewsServiceContract $service): JsonResponse
    {
        return $service->index($request);
    }

    /**
     * @param \App\Http\Requests\Api\News\StoreRequest             $request
     * @param \App\Contracts\Services\Http\Api\NewsServiceContract $service
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request, NewsServiceContract $service): JsonResponse
    {
        return $service->store($request);
    }
}