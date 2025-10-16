<?php

namespace App\Http\Controllers;

use App\Contracts\Services\Http\Api\NewsServiceContract;
use App\Http\Requests\Api\News\StoreRequest;

class NewsController
{

    public function store(StoreRequest $request, NewsServiceContract $service)
    {
        return $service->store($request);
    }
}