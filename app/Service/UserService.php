<?php

namespace App\Service;

use App\Models\User;
use App\Repository\UserRepository;
use Illuminate\Database\Eloquent\Collection;
use Exception;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @throws Exception
     */
    public function getUsers(): Collection
    {
        $users = $this->userRepository->getUsers();
        if (empty($users) || $users->count() === 0) {
            throw new Exception('Users not found');
        }
        return $users;
    }

    /**
     * @throws Exception
     */
    public function createUser(array $data): User
    {
        $result = $this->userRepository->create(
            $data['name'],
            $data['email'],
            Hash::make($data['password']),
        );
        if (!$result) {
            throw new Exception('User not created');
        }
        return $result;
    }

    /**
     * @throws Exception
     */
    public function updateUser(int $id, array $data): User
    {
        $user = $this->findUserById($id);
        $updated = $this->userRepository->update(
            $user,
            $data['name'],
            $data['email'],
            $data['password']
        );
        if (!$updated) {
            throw new Exception('User not updated');
        }
        return $this->findUserById($id);
    }

    /**
     * @throws Exception
     */
    public function deleteUser(int $id): bool
    {
        $user = $this->findUserById($id);
        return $this->userRepository->delete($user);
    }

    /**
     * @throws Exception
     */
    public function findUserById(int $id): User
    {
        $user = $this->userRepository->findById($id);
        if (!$user) {
            throw new Exception('User not found');
        }
        return $user;
    }
}
