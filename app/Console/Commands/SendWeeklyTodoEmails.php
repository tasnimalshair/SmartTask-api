<?php

namespace App\Console\Commands;

use App\Models\Todo;
use App\Models\User;
use App\Notifications\CompletedTodo;
use Illuminate\Console\Command;

class SendWeeklyTodoEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:weekly-todos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send weekly summary of completed todos to users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::all();

        foreach ($users as $user) {
            $todos = Todo::where('user_id', $user->id)
                ->where('is_completed', true)
                ->whereBetween('updated_at', [now()->startOfWeek(), now()->endOfWeek()])
                ->get();

            if ($todos->isNotEmpty()) {
                foreach ($todos as $todo) {
                    $user->notify(new CompletedTodo($todo->only(['id', 'title'])));
                }
            }
        }

        $this->info('Weekly todo emails sent!');
    }
}
