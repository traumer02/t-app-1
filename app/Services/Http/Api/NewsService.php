<?php

namespace App\Services\Http\Api;

use App\Contracts\Services\Http\Api\NewsServiceContract;
use App\Entities\Filters\Repositories\NewsRepository\PaginateFilter;
use App\Facades\Repository;
use App\Http\Requests\Api\News\IndexRequest;
use App\Http\Requests\Api\News\StoreRequest;
use App\Http\Resources\News\IndexResource;
use App\Services\BaseHttpService;
use Illuminate\Http\JsonResponse;

class NewsService extends BaseHttpService implements NewsServiceContract
{

    /**
     * @param \App\Http\Requests\Api\News\IndexRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(IndexRequest $request): JsonResponse
    {
        $page       = $request->safe()->integer('page', 1);
        $perPage    = $request->safe()->integer('perPage', 10);
        $title      = $request->safe()->string('title');
        $categoryID = $request->safe()->integer('category_id');
        $isParent   = $request->safe()->boolean('is_parent');
        $authorID   = $request->safe()->integer('author_id');
        $newsIds    = [];

        if ($categoryID != 0) {
            $parentCategory = Repository::category()->getOneByIdentifier($categoryID);

            if ($isParent) {
                $categories = Repository::category()->getManyByParentIdentifier($categoryID);
                $categories->push($parentCategory);

                $newsIds = Repository::newsCategory()
                    ->getManyByCategoryIdentifiers($categories->pluck('id')->toArray())
                    ->pluck('news_id')
                    ->toArray();
            } else {
                $newsIds = Repository::newsCategory()
                    ->getManyByCategoryIdentifiers([$parentCategory->id])
                    ->pluck('news_id')
                    ->toArray();
            }

            if (empty($newsIds)) {
                return $this->response->message('News not found')->fail();
            }
        }

        $news = Repository::news()->paginateByFilter(
            $page,
            $perPage,
            new PaginateFilter(
                [
                    'ids'       => $newsIds,
                    'title'     => $title,
                    'author_id' => $authorID,
                ]
            )
        );

        return $this->response
            ->data(new IndexResource($news->getCollection()))
            ->pagination(
                total:   $news->total(),
                perPage: $news->perPage(),
                current: $news->currentPage(),
                last:    $news->lastPage()
            )
            ->ok();
    }

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