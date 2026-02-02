<?php

namespace App\Filament\Trainer\Resources\TraineeResource\Pages;

use App\Filament\Trainer\Resources\TraineeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTrainee extends CreateRecord
{
    protected static string $resource = TraineeResource::class;
    
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
