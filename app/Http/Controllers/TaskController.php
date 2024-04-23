<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('tasks.index');
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
    public function store(Request $request)
    {
        $request->validate([
            "title" => "required|string",
            "description" => "required|string",
            "priority" => "required|string",
            "start" => "required",
            "end" => "required",
        ]);

        Task::create([
            'user_id' => $request->user()->id,
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
    public function show(Task $task)
    {
        //
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
}
