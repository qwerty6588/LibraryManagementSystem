<?php

declare(strict_types=1);

namespace App\Http\Requests;

class BookRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'title'          => ['required', 'array'],
            'title.uz'       => ['required', 'string', 'max:255'],
            'title.ru'       => ['required', 'string', 'max:255'],
            'title.en'       => ['required', 'string', 'max:255'],

            'description'    => ['required', 'array'],
            'description.uz' => ['required', 'string'],
            'description.ru' => ['required', 'string'],
            'description.en' => ['required', 'string'],

            'author_id'      => ['required', 'exists:authors,id'],
            'category_id'    => ['required', 'exists:categories,id'],
            'published_year' => ['nullable', 'digits:4'],
            'quantity'       => ['required', 'integer', 'min:0'],
            'price'          => ['required', 'numeric', 'min:0'],
            'image'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }
}
