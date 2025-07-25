<?php

namespace App\Service\Telegram;

use App\Models\User;

class TelegramService
{
    protected $telegram;

    public function __construct()
    {
        $this->telegram = new Telegram();
    }

    public function send(User $user, string $action)
    {
        $message = $this->prepareMessage($user, $action);
        return $this->telegram->send($message);
    }

    protected function prepareMessage(User $user, string $action): string
    {
        $emoji = match ($action) {
            'created' => '✅',
            'updated' => '✏️',
            'deleted' => '❌',
            default   => 'ℹ️',
        };

        return "{$emoji} User {$action}:\n"
            . "🆔 ID: {$user->id}\n"
            . "👤 Name: {$user->name}\n"
            . "📧 Email: {$user->email}";
    }
}
