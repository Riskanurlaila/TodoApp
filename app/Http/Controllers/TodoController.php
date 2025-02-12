<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TodoController extends Controller
{
    // Pastikan ada method untuk pencarian jika diperlukan
    public function search(Request $request)
    {
        $keyword = $request->input('search');
        $results = \App\Models\Task::where('name', 'like', "%$keyword%")->get();

        return view('pages.home', compact('results'));
    }
}
