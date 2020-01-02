<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TodoNotifications extends Notification
{
    use Queueable;
    public $todo;
  
    public function __construct($todo)
    {
        $this->todo = $todo;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'id' => $this->todo->id,
            'title' => $this->todo->title,
            'message' => $this->todo->status == 'A' ? 'Todo completed by: '.$this->todo->assigned_user->namespace : ($this->todo->status == 'C' ? 'Your awaiting todo successfully approved' : ($this->todo->status == 'P' ? $this->todo->created_user->name.'has assigned todo to you' : 'Task missed please give the reason')),
           

        ];
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
