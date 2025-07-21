<?php

namespace App\Service;

use Exception;
use App\Models\User;
use App\Service\TelegramService;
use App\Repository\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Collection;

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

        app(TelegramService::class)->sendMessage(
            "✏️ Пользователь создан:\n" .
            "🆔 id: ({$result->id})\n" .
            "👤 name: ({$result->name})\n" .
            "📧 email: ({$result->email})"
        );

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

            app(TelegramService::class)->sendMessage(
                "✏️ Пользователь обновлён:\n" .
                "🆔 id: ({$user->id})\n" .
                "👤 name: ({$user->name})\n" .
                "📧 email: ({$user->email})"
            );

        }

        return $updated;
    }

    /**
     * @throws Exception
     */
    public function deleteUser(int $id): bool
    {
        $user = $this->findUserById($id);
        $name = $user->name;
        $email = $user->email;

        $deleted = $this->userRepository->delete($user);

        if ($deleted) {

            app(TelegramService::class)->sendMessage(
                "✏️ Пользователь обновлён:\n" .
                "🆔 id: ({$id})\n" .
                "👤 name: ({$name})\n" .
                "📧 email: ({$email})"
            );

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
