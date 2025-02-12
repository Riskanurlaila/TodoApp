<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskList;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index() {
        $data = [
            'title' => 'Home',
            'lists' => TaskList::all(),
            'tasks' => Task::orderBy('created_at', 'desc')->get(),
            'priorities' => Task::PRIORITIES
        ];

        return view('pages.home', $data);
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $title = "Edit Tugas - " . $task->name; // Menambahkan variabel $title
        return view('pages.edit', compact('task', 'title'));
    }
    
            public function update(Request $request, $id)
        {
            $request->validate([
                'name' => 'required|max:100',
                'description' => 'required|max:255',
                'priority' => 'required|in:low,medium,high',
                'is_completed' => 'nullable|boolean'
            ]);

            $task = Task::findOrFail($id);
            $task->update([
                'name' => $request->name,
                'description' => $request->description,
                'priority' => $request->priority,
                'is_completed' => $request->has('is_completed') ? true : false
            ]);

            return redirect()->route('tasks.show', $task->id)->with('success', 'Tugas berhasil diperbarui!');
        }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|max:100',
            'description' => 'required|max:100',
            'priority' => 'required|in:low,medium,high',
            'list_id' => 'required'
        ]);

        Task::create([
            'name' => $request->name,
            'description' => $request->description,
            'priority' => $request->priority,
            'list_id' => $request->list_id
        ]);


        return redirect()->back();
    }

    public function complete($id) {
        Task::findOrFail($id)->update([
            'is_completed' => true
        ]);

        return redirect()->back();
    }

    public function destroy($id) {
        Task::findOrFail($id)->delete();

        return redirect()->back();
    }

    public function show($id) {
        $task  = Task::findOrFail($id);

        $data = [
            'title' => 'Details',
            'task' => $task,
        ];

        return view('pages.details', $data);
    }
}