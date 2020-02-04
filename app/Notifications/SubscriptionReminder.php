<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;
class SubscriptionReminder extends Notification
{
    use Queueable;
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    
    public function via($notifiable)
    {
        return ['database','broadcast'];
    }

    public function toArray($notifiable)
    {
        return [
            'id' => $this->data->id,
            'title' => "Subscription Contact",
            'url' => "show_subscription",
            'message' => $this->data->user_catg_name." want to subscription",
        ];
    }
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'id' => $this->data->id,
            'title' => "Subscription Contact",
            'url' => "show_subscription",
            'message' => $this->data->user_catg_name." want to subscription",
        ]);
    }
}
