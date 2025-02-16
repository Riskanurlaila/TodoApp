<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskList;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Menampilkan halaman utama dengan daftar tugas dan kategori tugas.
     * Mengambil semua daftar tugas dari database dan mengurutkan tugas berdasarkan waktu pembuatan (desc).
     */
    public function index() {
        $data = [
            'title' => 'Home', 
            'lists' => TaskList::all(), // Mengambil semua daftar kategori tugas 
            'tasks' => Task::orderBy('created_at', 'desc')->get(), // Mengambil semua tugas dan mengurutkannya 
            'priorities' => Task::PRIORITIES // Mengambil daftar prioritas tugas
        ];

        return view('pages.home', $data);
    }
    /**
     * Menyimpan tugas baru ke dalam database.
     * Melakukan validasi data sebelum disimpan.
     */
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|max:100',
            'description' => 'required|max:100',
            'priority' => 'required|in:low,medium,high',
            'list_id' => 'required'
        ]);
    // Menyimpan tugas baru
        Task::create([
            'name' => $request->name,
            'description' => $request->description,
            'priority' => $request->priority,
            'list_id' => $request->list_id
        ]);


        return redirect()->back();
    }
    /**
     * Menandai tugas sebagai selesai berdasarkan ID.
     */
    public function complete($id) {
        Task::findOrFail($id)->update([
            'is_completed' => true
        ]);

        return redirect()->back();
    }
    /**
     * Menghapus tugas berdasarkan ID.
     */
    public function destroy($id) {
        Task::findOrFail($id)->delete();

        return redirect()->back();
    }
    /**
     * Menampilkan detail tugas berdasarkan ID.
     */
    public function show($id) {
        $task  = Task::findOrFail($id);

        $data = [
            'title' => 'Details',
            'task' => $task,
        ];

        return view('pages.details', $data);
    }

    /**
     * Mengambil data tugas untuk diedit dalam format JSON.
     */
    public function edit($id) {
        $task = Task::findOrFail($id);
        return response()->json($task);
    }
     /**
     * Memperbarui data tugas berdasarkan ID.
     * Melakukan validasi sebelum memperbarui data.
     */
    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|max:100',
            'description' => 'required|max:100',
            'priority' => 'required|in:low,medium,high',
        ]);
    // Mengambil tugas yang akan diperbarui
        $task = Task::findOrFail($id);
        $task->update([
            'name' => $request->name,
            'description' => $request->description,
            'priority' => $request->priority
        ]);
    
        return redirect()->back();
    }
}