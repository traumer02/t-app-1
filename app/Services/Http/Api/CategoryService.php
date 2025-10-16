<?php

namespace App\Services\Http\Api;

use App\Contracts\Services\Http\Api\CategoryServiceContract;
use App\Facades\Repository;
use App\Http\Requests\Api\Category\StoreRequest;
use App\Services\BaseHttpService;
use Illuminate\Http\JsonResponse;

class CategoryService extends BaseHttpService implements CategoryServiceContract
{

    /**
     * @param \App\Http\Requests\Api\Category\StoreRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $parentID = $request->safe()->integer('parent_id');
        $name     = $request->safe()->string('name');
        $slug     = $request->safe()->string('slug');

        $existsBySlug = Repository::category()->existsBySlug($slug);

        if ($existsBySlug) {
            return $this->response
                ->message('Exists a category with slug "' . $slug . '"')
                ->fail();
        }

        Repository::category()->createOne(
            [
                'name'      => $name,
                'slug'      => $slug,
                'parent_id' => $parentID != 0 ? $parentID : null,
            ]
        );

        return $this->response->created()->ok();
    }
}