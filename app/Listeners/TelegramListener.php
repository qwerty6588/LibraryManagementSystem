<?php

namespace App\Listeners;

use App\Service\Telegram\TelegramService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TelegramListener
{
    protected $telegramService;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->telegramService = new TelegramService();
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $this->telegramService->send($event->user);
    }
}
