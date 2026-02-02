<?php

namespace App\Filament\Resources;

use Illuminate\Support\Facades\Hash;
use App\Filament\Resources\TrainerResource\Pages;
use App\Filament\Resources\TrainerResource\RelationManagers;
use App\Models\Trainer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TrainerResource extends Resource
{
    protected static ?string $model = Trainer::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    // Etiqueta para cuando es UNO solo (Ej: "Crear Ejercicio")
    protected static ?string $modelLabel = 'Entrenador';

    // Etiqueta para cuando son VARIOS (Menú lateral y Títulos de tabla)
    protected static ?string $pluralModelLabel = 'Entrenadores';
    
    // (Opcional) Si quieres que el botón del menú diga algo distinto al título:
    protected static ?string $navigationLabel = 'Entrenadores';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                ->label('Nombre Completo')
                ->required()
                ->maxLength(255),

                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                
                    Forms\Components\TextInput::make('password')
                    ->password() // Oculta los caracteres
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state)) // Encripta antes de guardar
                    ->dehydrated(fn ($state) => filled($state)) // Si no escriben nada (al editar), no sobreescribe la pass actual
                    ->required(fn (string $context): bool => $context === 'create'), // Obligatorio solo al crear

                Forms\Components\TextInput::make('specialty_type')
                    ->label('Especialidad (Ej: Pesas, Yoga)')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('max_clients')
                    ->label('Cupo Máximo')
                    ->numeric()
                    ->default(20)
                    ->required(),

                Forms\Components\Section::make('Módulos del Entrenador')
                    ->description('Selecciona qué servicios puede ofrecer este entrenador.')
                    ->schema([
                        Forms\Components\Toggle::make('has_nutrition_plan')
                            ->label('Habilitar Plan Alimenticio')
                            ->onColor('success')
                            ->default(false),
                            
                        Forms\Components\Toggle::make('has_workout_plan')
                            ->label('Habilitar Rutinas')
                            ->onColor('success')
                            ->default(true),
                    ])->columns(2),



            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                ->label('Nombre')
                ->searchable()  //permite buscar por nombre
                ->sortable()    //ordena de a-z
                ->weight('bold'), // Pone el nombre en negrita,

            Tables\Columns\TextColumn::make('specialty_type')
                ->label('Especialidad')
                ->badge()
                ->color('info'),

            Tables\Columns\TextColumn::make('max_clients')
                ->label('Cupo')
                ->sortable(),

            Tables\Columns\IconColumn::make('has_nutrition_plan')
                ->label('Dieta')
                ->boolean(),

            Tables\Columns\IconColumn::make('has_workout_plan')
                ->label('Rutina')
                ->boolean(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTrainers::route('/'),
            'create' => Pages\CreateTrainer::route('/create'),
            'edit' => Pages\EditTrainer::route('/{record}/edit'),
        ];
    }
}
