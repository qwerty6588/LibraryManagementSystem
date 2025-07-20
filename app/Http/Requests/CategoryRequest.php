<?php

namespace App\Http\Requests;

class CategoryRequest extends BaseRequest
{

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:categories,name,' . $this->route('category'),
            'description' => 'nullable|string|max:1000',
        ];
    }
}
