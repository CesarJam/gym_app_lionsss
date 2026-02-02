<?php

namespace App\Filament\Trainer\Resources;

use Illuminate\Support\Facades\Auth;
use App\Filament\Trainer\Resources\TraineeResource\Pages;
use App\Filament\Trainer\Resources\TraineeResource\RelationManagers;
use App\Models\Trainee;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TraineeResource extends Resource
{
    protected static ?string $model = Trainee::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    // Etiqueta para cuando es UNO solo
    protected static ?string $modelLabel = 'Asesorado';

    // Etiqueta para cuando son VARIOS (Menú lateral y Títulos de tabla)
    protected static ?string $pluralModelLabel = 'Asesorados';
    
    // (Opcional) Si quieres que el botón del menú diga algo distinto al título:
    protected static ?string $navigationLabel = 'Asesorados';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                
            Forms\Components\Hidden::make('trainer_id')
                ->default(Auth::id()) // <--- ¡Aquí ocurre la magia! Toma el ID del usuario conectado.
                ->required(),

            Forms\Components\TextInput::make('name')
                ->label('Nombre Completo')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('email')
                ->email()
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('phone')
                ->label('Teléfono')
                ->tel()
                ->maxLength(255),

            Forms\Components\Section::make('Datos Físicos')
                ->schema([
                    Forms\Components\DatePicker::make('birth_date')
                        ->label('Fecha de Nacimiento')
                        ->native(false), // Usa el calendario bonito de Filament
                        
                    Forms\Components\TextInput::make('weight')
                        ->label('Peso Actual (kg)')
                        ->numeric()
                        ->suffix('kg'),

                    Forms\Components\TextInput::make('height')
                        ->label('Altura (cm)')
                        ->numeric()
                        ->suffix('cm'),
                ])->columns(3), // Muestra los 3 campos en una sola fila

            Forms\Components\Textarea::make('goal')
                ->label('Objetivo del Entrenamiento')
                ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            Tables\Columns\TextColumn::make('name')
                ->label('Nombre')
                ->searchable() // Permite buscar por nombre
                ->sortable()   // Permite ordenar A-Z
                ->weight('bold'), // Pone el nombre en negrita

            Tables\Columns\TextColumn::make('email')
                ->label('Correo Electrónico')
                ->icon('heroicon-m-envelope') // Añade un icono pequeño
                ->copyable(), // Permite copiar el email con un clic

            Tables\Columns\TextColumn::make('phone')
                ->label('Teléfono')
                ->default('No registrado'),

            Tables\Columns\TextColumn::make('goal')
                ->label('Objetivo')
                ->limit(30) // Si el texto es muy largo, lo corta con "..."
                ->tooltip(fn (Tables\Columns\TextColumn $column): ?string => $column->getState()), // Muestra el texto completo al pasar el mouse
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
            'index' => Pages\ListTrainees::route('/'),
            'create' => Pages\CreateTrainee::route('/create'),
            'edit' => Pages\EditTrainee::route('/{record}/edit'),
        ];
    }
    public static function getEloquentQuery(): Builder
    {
        // Obtiene la consulta original y le agrega: "DONDE trainer_id sea igual al MÍO"
        return parent::getEloquentQuery()->where('trainer_id', Auth::id());
    }
}
