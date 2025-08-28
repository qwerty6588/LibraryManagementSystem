<?php

declare(strict_types=1);

namespace App\Http\Requests;

class BookRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'title'          => 'required|string|max:255',
            'author_id'      => 'required|string|max:255',
            'category_id'    => 'required|string|max:255',
            'description'    => 'nullable|string',
            'published_year' => 'required|date_format:Y',
            'price'          => 'required|numeric|min:0',
            'quantity'       => 'required|integer|min:1',
            'image'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }

}
