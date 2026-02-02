<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'muscle_group',
        'specific_muscle',
        'equipment',
        'image_path',
        'is_favorite',
        'details',
        'video_url',
    ];

    // TU LISTA MAESTRA DE MÚSCULOS
    public const MUSCLE_GROUPS = [
        'Abdomen' => ['Abdomen'],
        'Brazos' => ['Antebrazos', 'Bíceps', 'Tríceps'],
        'Cardio' => ['Cardio'],
        'Cuello' => ['Cuello'],
        'Espalda' => ['Columna vertebral', 'Espalda alta', 'Lats', 'Trapecio'],
        'Hombros' => ['Hombros'],
        'Pecho' => ['Pectorales', 'Serratus anterior'],
        'Piernas' => ['Abductores', 'Adductores', 'Cuádriceps', 'Glúteos', 'Isquiotibiales', 'Pantorrillas'],
    ];
}