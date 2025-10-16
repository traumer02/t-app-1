<?php

namespace App\Contracts\Services\Http\Api;

use App\Http\Requests\Api\News\IndexRequest;
use App\Http\Requests\Api\News\StoreRequest;
use Illuminate\Http\JsonResponse;

interface NewsServiceContract
{

    /**
     * @param \App\Http\Requests\Api\News\IndexRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(IndexRequest $request): JsonResponse;

    /**
     * @param \App\Http\Requests\Api\News\StoreRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse;
}