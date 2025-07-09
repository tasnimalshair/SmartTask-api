<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class CompletedTodo extends Notification implements ShouldQueue
{
    use Queueable;

    public $todo;

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
            ->subject('Todo Completed')
            ->line("The task \"{$this->todo->title}\" has been marked as completed.")
            ->action('View Task', url('/todos/' . $this->todo->id))
            ->line('Good job!');
    }

    public function toDatabase($notifiable)
    {
        return [
            'todo_id' => $this->todo->id,
            'title' => $this->todo->title,
            'message' => 'You have completed a task!',
        ];
    }

    public function toArray($notifiable)
    {
        return 'no';
    }
}
