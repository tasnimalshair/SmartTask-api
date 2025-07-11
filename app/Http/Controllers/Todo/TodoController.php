<?php

namespace App\Http\Controllers\Todo;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Http\Resources\TodoResource;
use Illuminate\Http\Request;
use App\Http\Traits\ApiResponse;
use App\Models\Todo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TodoController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $user_id = Auth::id();
        $todos = Todo::where('user_id', $user_id)->get();
        return $this->success(
            $todos->isEmpty() ? 'No todos yet!' : 'Todos got successfully!',
            200,
            TodoResource::collection($todos)
        );
    }

    public function show($id)
    {
        $user_id = Auth::id();
        $todo = Todo::query()->where('id', $id)->where('user_id', $user_id)->firstOrFail();
        return $this->success('Todo get successfully!', 200, new TodoResource($todo));
    }

    public function store(AddTodoRequest $request)
    {
        $user_id = Auth::id();
        $data = $request->validated();
        $data['user_id'] = $user_id;
        $todo = Todo::query()->create($data);
        return $this->success('Todo added successfully!', 201, new TodoResource($todo));
    }

    public function update(UpdateTodoRequest $request, $id)
    {
        $user_id = Auth::id();
        $todo = Todo::query()->where('user_id', $user_id)->where('id', $id)->firstOrFail();
        $data = $request->validated();
        $data['user_id'] = $user_id;
        $todo->update($data);
        return $this->success('Todo updated successfully!', 200, new TodoResource($todo));
    }

    public function destroy($id)
    {
        $user_id = Auth::id();
        $todo = Todo::query()->findOrFail($id);
        if ($todo->user_id !== $user_id) {
            return $this->error('Unautherized to delete this todo', 403);
        }

        $todo->delete();
        return $this->successMessage('Todo deleted successfully!', 200);
    }
}
