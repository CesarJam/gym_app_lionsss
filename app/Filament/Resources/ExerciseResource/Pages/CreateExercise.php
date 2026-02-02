<?php

namespace App\Filament\Resources\ExerciseResource\Pages;

use App\Filament\Resources\ExerciseResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateExercise extends CreateRecord
{
    protected static string $resource = ExerciseResource::class;

    protected function getRedirectUrl(): string
    {
        // Le dice a Filament: "Obtén la URL de la página 'index' (la tabla) de este recurso"
        return $this->getResource()::getUrl('index');
    }
}
