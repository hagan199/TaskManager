<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $projectId = $request->input('project_id');

        $tasks = Task::orderBy('priority')
            ->when($projectId, function ($query) use ($projectId) {
                return $query->where('project_id', $projectId);
            })
            ->with('project')
            ->get();

        $projects = Project::all();

        return view('tasks.index', compact('tasks', 'projects', 'projectId'));
    }

    public function create()
    {
        $projects = Project::all();
        return view('tasks.create', compact('projects'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'priority' => 'required|integer|min:0',
            'project_id' => [
                'nullable',
                'integer',
                Rule::exists('projects', 'id')->where(function ($query) {
                    $query->where('deleted_at', null);
                }),
            ],
        ];

        $request->validate($rules);

        Task::create([
            'name' => $request->input('name'),
            'priority' => $request->input('priority'),
            'project_id' => $request->input('project_id'),
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'priority' => 'required|integer|min:0',
        ]);

        $task->update([
            'name' => $request->input('name'),
            'priority' => $request->input('priority'),
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}
