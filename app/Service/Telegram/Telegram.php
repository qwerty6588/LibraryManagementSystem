<?php

namespace App\Service\Telegram;

use Telegram\Bot\Api;
use Telegram\Bot\Exceptions\TelegramSDKException;

class Telegram
{
    public Api $telegram;

    public function __construct()
    {
        $this->telegram = new Api(config('telegram.bots.mybot.token'));
    }

    /**
     * @throws TelegramSDKException
     */
    public function getUpdates(): void
    {
        $this->telegram->getUpdates();
    }

    /**
     * @throws TelegramSDKException
     */
    public function send($message): \Telegram\Bot\Objects\Message
    {
        return $this->telegram->sendMessage([
            'chat_id' => config('telegram.group_id'),
            'text' => $message,
            'parse_mode' => 'HTML'
        ]);
    }
}
