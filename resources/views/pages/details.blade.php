@extends('layouts.app')

@section('content')
<br>
<br>
<br>
<br>
    <div class="container">
        <h1 class="mb-3">Details</h1>

        
        <div class="card shadow p-4">
            <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label fw-bold">Nama Tugas</label>
                    <input type="text" name="name" class="form-control" value="{{ $task->name }}" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label fw-bold">Deskripsi</label>
                    <textarea name="description" class="form-control" rows="3">{{ $task->description }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="priority" class="form-label fw-bold">Prioritas</label>
                    <select name="priority" class="form-select">
                        <option value="low" {{ $task->priority == 'low' ? 'selected' : '' }}>🟢 Low</option>
                        <option value="medium" {{ $task->priority == 'medium' ? 'selected' : '' }}>🟡 Medium</option>
                        <option value="high" {{ $task->priority == 'high' ? 'selected' : '' }}>🔴 High</option>
                    </select>
                </div>
                
         </form>
        </div>
    </div>
@endsection