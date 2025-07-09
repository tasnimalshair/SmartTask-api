<?php

namespace App\Http\Controllers\Todo;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateTodoRequest;
use App\Http\Traits\ApiResponse;
use App\Models\Todo;
use App\Notifications\CompletedTodo;
use Illuminate\Support\Facades\Auth;


class TodoOperationsController extends Controller
{
    use ApiResponse;
    public function toggleCompletion($id)
    {
        $todo = Todo::query()->where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $todo->is_completed = !$todo->is_completed;
        $todo->save();
        if ($todo->is_completed) {

            Auth::user()->notify(new CompletedTodo($todo));
        }
        return $this->success('Completion status updated successfully!', 200, $todo);
    }
}
