@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-3">✏️ Edit Tugas</h1>

        
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

                <div class="mb-3">
                    <label class="form-check-label fw-bold">
                        <input type="checkbox" name="status" value="1" {{ $task->status ? 'checked' : '' }}>
                        ✅ Tandai sebagai selesai
                    </label>
                </div>
                
                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning">
                    ✏️ Edit Tugas
                </a>

                <div class="d-right gap-2">
                    <button type="submit" class="btn btn-success">
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-secondary">
                        ❌ Batal
                    </a>
                </div>
                
            </form>
        </div>
    </div>
@endsection
