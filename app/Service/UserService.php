<?php

namespace App\Service;

use App\Events\TelegramEvent;
use App\Models\User;
use App\Repository\UserRepository;
use App\Service\Telegram\Telegram;
use Exception;
use Illuminate\Database\Eloquent\Collection;
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


        TelegramEvent::dispatch($result, 'created');

        return $result;
    }

    /**
     * @throws Exception
     */
    public function updateUser(int $id, array $data): bool
    {
        $user = User::findOrFail($id);

        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $updated = $user->update($data);

        if ($updated) {
            TelegramEvent::dispatch($user, 'updated');
        }

        return $updated;
    }


    /**
     * @throws Exception
     */
    public function deleteUser(int $id): bool
    {
        $user = $this->findUserById($id);

        $deleted = $this->userRepository->delete($user);

        if ($deleted) {
            TelegramEvent::dispatch($user, 'deleted');
        }

        return $deleted;
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
