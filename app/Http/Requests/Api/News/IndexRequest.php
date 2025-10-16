<?php

namespace App\Http\Requests\Api\News;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'page'        => 'nullable|int',
            'per_page'    => 'nullable|int',
            'title'       => 'nullable|string',
            'author_id'   => 'nullable|integer|exists:authors,id',
            'category_id' => 'nullable|integer|exists:categories,id',
            'is_parent'   => 'nullable|boolean',
        ];
    }
}
