<?php

namespace App\Http\Controllers\Todo;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponse;
use App\Models\Todo;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TodoStatController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $user_id = Auth::id();

        $totalTodos = Todo::where('user_id', $user_id)
            ->count();


        $completedToday = Todo::where('user_id', $user_id)
            ->where('is_completed', true)
            ->whereDate('updated_at', now()->today())
            ->count();

        $weeklyCompleted = Todo::where('user_id', $user_id)
            ->where('is_completed', true)
            ->whereBetween('updated_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->count();

        $completionRate = $totalTodos > 0 ? round(($weeklyCompleted / $totalTodos) * 100)  : 0;
        return response()->json([
            'completed_today' => $completedToday,
            'completed_this_week' => $weeklyCompleted,
            'total_tasks' => $totalTodos,
            'completion_rate' => "{$completionRate}%",
        ]);
    }
}
