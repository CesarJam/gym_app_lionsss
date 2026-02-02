<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Foundation\Auth\User as Authenticatable; // OJO: Ya no extiende de Model
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Trainer extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password', // Agregamos password
        'specialty_type',
        'max_clients',
        'has_nutrition_plan',
        'has_workout_plan',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed', // Encripta la contraseña automáticamente
        'has_nutrition_plan' => 'boolean',
        'has_workout_plan' => 'boolean',
    ];

    // Esta función define quién puede entrar al panel de entrenadores
    public function canAccessPanel(Panel $panel): bool
    {
        // Aquí podrías poner lógica extra, por ahora retornamos true
        // para que cualquier entrenador registrado pueda entrar a su panel.
        return true; 
    }
    public function trainees() //para que el entrenador pueda ver a sus alumnos
    {
        return $this->hasMany(Trainee::class);
    }
}