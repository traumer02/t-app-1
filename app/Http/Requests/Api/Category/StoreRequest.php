<?php

namespace App\Http\Requests\Api\Category;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name'      => 'required|string',
            'slug'      => 'required|string',
            'parent_id' => 'nullable|integer|exists:categories,id',
        ];
    }
}
