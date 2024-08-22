<?php

namespace App\Services;

use App\Models\Task;

class TaskService
{
    public function index()
    {
        return Task::where('user_id', request()->header('User-Id'))
            ->orderBy('id', 'desc')->get();
    }

    public function store(array $data)
    {
        $task = new Task();
        $task->user_id = request()->header('User-Id');
        $task->content = $data['content'];
        $task->save();

        return $task;
    }

    public function show(string $id)
    {
        return Task::findOrFail($id);
    }

    public function update(array $data, string $id)
    {
        $task = Task::findOrFail($id);
        $task->update($data);

        return $task;
    }

    public function destroy(string $id)
    {
        return Task::findOrFail($id)->delete();
    }
}
