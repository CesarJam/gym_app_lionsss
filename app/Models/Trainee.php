<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainee extends Model
{
    use HasFactory;

    protected $fillable = [
        'trainer_id', // Importante para la asignación automática
        'name',
        'email',
        'phone',
        'birth_date',
        'weight',
        'height',
        'goal',
    ];

    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }
}