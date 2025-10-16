<?php

namespace App\Services\Http\Api;

use App\Contracts\Services\Http\Api\AuthorServiceContract;
use App\Facades\Repository;
use App\Http\Requests\Api\Author\StoreRequest;
use App\Services\BaseHttpService;
use Illuminate\Http\JsonResponse;

class AuthorService extends BaseHttpService implements AuthorServiceContract
{

    /**
     * @param \App\Http\Requests\Api\Author\StoreRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $name   = $request->safe()->string('name');
        $email  = $request->safe()->string('email');
        $avatar = $request->safe()->string('avatar');

        $authorExists = Repository::author()->existsByEmail($email);

        if ($authorExists) {
            return $this->response
                ->message('Such an email already exists')
                ->fail();
        }

        Repository::author()->createOne(
            [
                'name'   => $name,
                'email'  => $email,
                'avatar' => $avatar->isNotEmpty() ? $avatar : null,
            ]
        );

        return $this->response->created()->ok();
    }
}