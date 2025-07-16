<?php

namespace App\Http\Controllers;

use App\Models\Todo;

class TodosController extends Controller
{
    public function index()
    {
        $todos = Todo::with('user')->get()->map(function ($todo) {
            return [
                'userId' => $todo->user_id,
                'id' => $todo->id,
                'title' => $todo->title,
                'completed' => (bool) $todo->completed,
            ];
        });

        return response()->json($todos);
    }

    public function show($id)
    {
        $todo = Todo::with('user')->findOrFail($id);

        return response()->json([
            'userId' => $todo->user_id,
            'id' => $todo->id,
            'title' => $todo->title,
            'completed' => (bool) $todo->completed,
        ]);
    }
}
