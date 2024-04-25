<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'id' => auth()->id(),
            'type' => 'User',
            'heading' => 'Personal',
            'model' => auth()->user()
        ];
        return view('tasks.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $model = [
        "User" => User::class,
        "Team" => Team::class,
        ][$request->input('type')]::find($id);

        $request->validate([
            "title" => "required|string",
            "description" => "required|string",
            "priority" => "required|string",
            "start" => "required",
            "end" => "required",
        ]);

        $model->tasks()->create([
            "title" => $request->title,
            "description" => $request->description,
            "priority" => $request->priority,
            "start" => $request->start,
            "end" => $request->end,
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team)
    {
        $data = [
            'id' => $team->id,
            'type' => 'Team',
            'heading' => $team->name,
            'model' => $team
        ];
        return view('tasks.index', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id = null)
    {
        $request->validate([
            "id" => "integer",
            "title" => "string",
            "description" => "string",
            "priority" => "string",
        ]);

        $task = Task::find($id ?? $request->id);

        $data = array_filter(
            $request->all(),
            fn($key) => in_array($key, ['title', 'description', 'status', 'priority', 'start', 'end']),
            ARRAY_FILTER_USE_KEY,
        );

        if ($task) {
            $task->update([...$data]);
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }

    public function all(Request $request) {
        $backgroundColors = [
            'to do' => '#ef4444',
            'in progress' => '#d97706',
            'done' => '#10b981',
        ];

        $tasks = [];
        foreach ($request->user()->tasks as $task) {
            $tasks[] = [
                ...$task->toArray(),
                "backgroundColor" => $backgroundColors[$task->status],
            ];
        }

        return response()->json([
            "events" => $tasks
        ]);
    }
}
