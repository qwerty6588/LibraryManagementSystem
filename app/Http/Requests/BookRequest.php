<?php

declare(strict_types=1);

namespace App\Http\Requests;

class BookRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'author_name' => 'required|string|max:255',
            'category_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'published_year' => 'required|integer|min:1000|max:2100',
        ];
    }

}
