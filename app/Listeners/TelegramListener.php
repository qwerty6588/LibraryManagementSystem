<?php

namespace App\Listeners;

use App\Service\Telegram\TelegramService;

class TelegramListener
{
    protected $telegramService;

    public function __construct()
    {
        $this->telegramService = new TelegramService();
    }

    public function handle($event)
    {
        $user = $event->user;
        $action = $event->action;

        $this->telegramService->send($user, $action);
    }
}
