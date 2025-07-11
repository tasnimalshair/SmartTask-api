<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class CompletedTodo extends Notification implements ShouldQueue
{
    use Queueable;

    protected $todo;

    public function __construct($todo)
    {
        $this->todo = $todo;
    }

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject("🎯 Task Completed – You're on fire! ")
            ->line("Hey {$notifiable->name}! ")
            ->line("{$this->todo->title} is ✔️ Done. ")
            ->line("You're seriously on a roll 🔥")
            ->line("Keep smashing those goals — SmartTask is cheering for you 🙌")
            ->line('Good job!');
    }

    public function toDatabase($notifiable)
    {
        return [
            'todo_id' => $this->todo['id'],
            'title' => $this->todo['title'],
            'message' => 'Completed task!',
        ];
    }

    public function toArray($notifiable)
    {
        return 'no';
    }
}
