<?php

namespace App\Http\Resources\News;

use App\Models;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

class IndexResource extends JsonResource
{

    /**
     * @var \Illuminate\Database\Eloquent\Collection<integer, \App\Models\News>
     */
    private Collection $news;

    /**
     * @param $resource
     */
    public function __construct($resource)
    {
        parent::__construct($resource);

        $this->news = $resource;
    }

    /**
     * @param $request
     *
     * @return array
     */
    public function toArray($request = null): array
    {
        return $this->news->map(
            fn(Models\News $news) => $this->prepareNews($news)
        )
            ->all()
        ;
    }

    /**
     * @param \App\Models\News $news
     *
     * @return array
     */
    private function prepareNews(Models\News $news): array
    {
        return [
            'id'          => $news->id,
            'title'       => $news->title,
            'excerpt' => $news->excerpt,
            'content' => $news->content,
            'published_at'    => !is_null($news->published_at) ? Carbon::createFromDate($news->published_at)->timestamp :
                $news->published_at?->timestamp,
        ];
    }
}
