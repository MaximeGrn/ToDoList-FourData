<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // Attributs de la tâche modifiables en masse
    protected $fillable = [
        'nom',
        'description',
        'status',
        'echeance'
    ];

    // ... autres déclarations ...

    public function todoList()
    {
        return $this->belongsTo(TodoList::class);
    }
}
