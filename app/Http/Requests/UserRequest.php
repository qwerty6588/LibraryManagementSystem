<?php

declare(strict_types=1);

namespace App\Http\Requests;

class UserRequest extends BaseRequest
{

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'role_id' => 'required|integer|exists:roles,id',
            'password' => 'required|string|min:6|confirmed',
        ];
    }
}
