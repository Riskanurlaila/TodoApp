<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskList extends Model
{
    /**
     * Mendefinisikan atribut yang dapat diisi secara massal.
     */
    protected $fillable = ['name'];
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];
    /**
     * Relasi dengan model Task.
     * Setiap daftar tugas (TaskList) dapat memiliki banyak tugas (Task).
     */
    public function tasks() {
        return $this->hasMany(Task::class, 'list_id');
    }
}
