<?php

namespace App\Http\Requests\Api\Author;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name'   => 'required|string',
            'email'  => 'required|max:255',
            'avatar' => 'nullable|string',
        ];
    }
}
