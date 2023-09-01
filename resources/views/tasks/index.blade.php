<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="bg-black text-white text-center text-3xl p-3">
      All Tasks
    </div>
    <div class="max-w-screen-xl m-auto p-2">
      <a href="{{ route('home') }}">Home</a> > <a href="{{ route('tasks.index') }}">All Tasks</a>
    </div>
    <div class="text-center my-5">
      <div class="max-w-screen-lg m-auto bg-green-500 text-white font-bold p-2 text-2xl">
        <a href="{{ route('tasks.create') }}">Create Tasks</a>
      </div>
    </div>

    @if (session()->has('status'))
        <div class="bg-green-600 text-center text-white">{{ session('status') }}</div>
    @endif
    <div class="max-w-screen-lg m-auto bg-stone-200 p-2">
        <form action="{{ route('tasks.index') }}" method="GET">
            <div class="mb-3">
                <label for="projectSelect" class="block">Select Project:</label>
                <select id="projectSelect" name="project_id" class="border rounded py-1 px-2">
                    <option value="">All Projects</option>
                    @foreach ($projects as $project)
                        <option value="{{ $project->id }}" {{ $project->id == $projectId ? 'selected' : '' }}>{{ $project->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="bg-blue-500 text-white py-1 px-2 rounded ml-2">Filter</button>
            </div>
        </form>
        <table class="table-auto">
            <thead>
                <tr>
                    <th class="px-4 py-2">Task ID</th>
                    <th class="px-4 py-2">Task Name</th>
                    <th class="px-4 py-2">Priority</th>
                    <th class="px-4 py-2">Project Name</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                <tr>
                    <td class="px-4 py-2">{{ $task->id }}</td>
                    <td class="px-4 py-2">
                        <a href="{{ route('tasks.show', $task) }}">{{ $task->name }}</a>
                    </td>
                    <td class="px-4 py-2" style="background-color: {{ $task->priority === 2 ? 'red' : 'yellow' }}">
                        {{ $task->priority }}
                    </td>

                    <td class="px-4 py-2">
                        @if ($task->project)
                            {{ $task->project->name }}
                        @else
                            No Project Assigned
                        @endif
                    </td>
                    <td class="px-4 py-2">
                        <a href="{{ route('tasks.edit', $task) }}" class="text-blue-500">Edit</a>
                        |
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500" onclick="return confirm('Are you sure you want to delete this task?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>


    </div>



</body>
</html>
