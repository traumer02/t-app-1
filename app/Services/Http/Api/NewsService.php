<?php

namespace App\Services\Http\Api;

use App\Contracts\Services\Http\Api\NewsServiceContract;
use App\Facades\Repository;
use App\Http\Requests\Api\News\StoreRequest;
use App\Services\BaseHttpService;
use Illuminate\Http\JsonResponse;

class NewsService extends BaseHttpService implements NewsServiceContract
{

    /**
     * @param \App\Http\Requests\Api\News\StoreRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $authorID    = $request->safe()->integer('author_id');
        $categoryID  = $request->safe()->integer('category_id');
        $publishedAt = $request->safe()->date('published_at');
        $title       = $request->safe()->string('title');
        $excerpt     = $request->safe()->string('excerpt');
        $content     = $request->safe()->string('content');

        $news = Repository::news()->createOne(
            [
                'title'        => $title,
                'excerpt'      => $excerpt,
                'content'      => $content,
                'published_at' => $publishedAt,
                'author_id'    => $authorID,
            ]
        );

        Repository::newsCategory()->createOne(
            [
                'news_id'     => $news->id,
                'category_id' => $categoryID,
            ]
        );

        return $this->response->created()->ok();
    }
}