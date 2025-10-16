<?php

namespace App\Http\Requests\Api\News;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'title'        => 'required|string',
            'excerpt'      => 'required|string',
            'content'      => 'required|string',
            'published_at' => 'required',
            'author_id'    => 'required|integer|exists:authors,id',
            'category_id'  => 'required|integer|exists:categories,id',
        ];
    }
}
