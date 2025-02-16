<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TaskList;

class Task extends Model
{
     /**
     * Mendefinisikan atribut yang dapat diisi secara massal.
     */
    protected $fillable = [
        'name',
        'description',
        'is_completed',
        'priority',
        'list_id'
    ];
    /**
     * Mendefinisikan atribut yang tidak boleh diisi secara massal.
     */
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];
     /**
     * Konstanta daftar prioritas tugas yang tersedia.
     */
    const PRIORITIES = [
        'low',
        'medium',
        'high'
    ];

     /**
     * Mendapatkan kelas CSS berdasarkan tingkat prioritas tugas.
     * Digunakan untuk memberikan warna yang sesuai dalam tampilan UI.
     */

    public function getPriorityClassAttribute() {
        return match($this->attributes['priority']) {
            'low' => 'success',
            'medium' => 'warning',
            'high' => 'danger',
            default => 'secondary'
        };
    }
     /**
     * Relasi dengan model TaskList.
     * Menunjukkan bahwa setiap tugas (Task) dimiliki oleh satu daftar tugas (TaskList).
     */
    public function list() {
        return $this->belongsTo(TaskList::class, 'list_id');
    }
}
