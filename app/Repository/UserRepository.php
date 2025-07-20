<?php

namespace App\Repository;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;


class UserRepository extends BaseRepository
{
    public function getModel(): string
    {
      return User::class;
    }

    public function getUsers(): Collection
    {
        return $this->model::all();
    }

    public function create(
        string $name,
        string $email,
        string $password,
    ): ?User
    {
        return $this->model::create([
            'name' => $name,
            'email' => $email,
            'password' => $password
        ]);
    }

    public function update(User $user, string $name, string $phone, string $password): bool
    {
        return $user->update([
            'name' => $name,
            'phone' => $phone,
            'password' => $password
        ]);
    }

    public function delete(User $user): bool
    {
        return $user->delete();
    }

    public function findById(int $id): ?User
    {
        return $this->model::find($id) ?: null;
    }
}
