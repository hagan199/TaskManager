<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="bg-black text-white text-center text-3xl p-3">
      Create Task
    </div>
    <div class="max-w-screen-xl m-auto p-2">
      <a href="{{ route('home') }}">Home</a> > <a href="{{ route('tasks.index') }}">All Tasks</a> > <a href="{{ route('tasks.create') }}">Create Task</a>
    </div>
    @if ($errors->any())
        @foreach ($errors->all() as $message)
            <div class="bg-red-400 text-center text-white">{{ $message }}</div>
        @endforeach
    @endif
    <div class="max-w-screen-lg m-auto bg-stone-200 p-2">
        <form class="p-4" action="{{ route('tasks.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <label for="name">Task Name</label>
            <input class="w-full p-2" type="text" name="name">

            <label for="priority">Priority</label>
            <select class="m-1 w-full" name="priority">
                <option value="1">Less Priority</option>
                <option value="2">More Priority</option>

            </select>

            <label for="project_id">Project</label>
            <select class="m-1 w-full" name="project_id">
                <option value="">Select Project</option>
                @foreach ($projects as $project)
                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                @endforeach
            </select>

            <input class="w-full bg-green-400 p-3 font-center text-white text-2xl cursor-pointer" type="submit" value="Create Task">
        </form>

    </div>
</body>
</html>
