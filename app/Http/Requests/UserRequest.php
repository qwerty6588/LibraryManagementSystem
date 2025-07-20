<?php

declare(strict_types=1);

namespace App\Http\Requests;

class UserRequest extends BaseRequest
{

    public function rules(): array
    {
        $userId = $this->route('user');

        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $userId,
            'password' => $this->isMethod('post') ? 'required|string|min:6|confirmed' : 'nullable|string|min:6|confirmed',
        ];
    }
}
