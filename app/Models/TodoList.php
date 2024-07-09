<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodoList extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom', // Nom de la TodoList
        // ... autres attributs si besoin (description, etc.)
    ];

    // ... autres déclarations ...

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
