<?php

namespace App\Http\Controllers;

use App\Models\TaskList;
use Illuminate\Http\Request;

class TaskListController extends Controller
{
     /**
     * Menyimpan daftar tugas baru ke dalam database.
     * Melakukan validasi sebelum menyimpan data.
     */
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|max:100',
        ]);
    // Membuat daftar tugas baru
        TaskList::create([
            'name' => $request->name,
        ]);

        return redirect()->back();
    }
     /**
     * Menghapus daftar tugas berdasarkan ID.
     */
    public function destroy($id) {
        TaskList::findOrFail($id)->delete();

        return redirect()->back();
    }
}
