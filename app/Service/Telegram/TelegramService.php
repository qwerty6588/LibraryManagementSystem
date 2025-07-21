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

    public function send($message)
    {
        return $this->telegram->send($this->prepareMessage($message));
    }

    protected function prepareMessage(User $user)
    {
        return  "✏️ Пользователь создан:\n" .
            "🆔 id: ({$user->id})\n" .
            "👤 name: ({$user->name})\n" .
            "📧 email: ({$user->email})";
    }
}
