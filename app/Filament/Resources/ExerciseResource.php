<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExerciseResource\Pages;
use App\Filament\Resources\ExerciseResource\RelationManagers;
use App\Models\Exercise;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Enums\FiltersLayout; // para los filtros de la tabla

use Filament\Forms\Get;  // Importante para la interactividad

class ExerciseResource extends Resource
{
    protected static ?string $model = Exercise::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    // Etiqueta para cuando es UNO solo (Ej: "Crear Ejercicio")
    protected static ?string $modelLabel = 'Ejercicio';

    // Etiqueta para cuando son VARIOS (Menú lateral y Títulos de tabla)
    protected static ?string $pluralModelLabel = 'Ejercicios';
    
    // (Opcional) Si quieres que el botón del menú diga algo distinto al título:
    protected static ?string $navigationLabel = 'Ejercicios';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nombre del Ejercicio')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),

                // SELECT 1: GRUPO MAYOR
                Forms\Components\Select::make('muscle_group')
                    ->label('Grupo Muscular')
                    ->options(array_combine(
                        array_keys(Exercise::MUSCLE_GROUPS),
                        array_keys(Exercise::MUSCLE_GROUPS)
                    )) // Carga las llaves: Brazos, Piernas, etc.
                    ->live() // ¡Importante! Hace que el formulario reaccione al cambio
                    ->afterStateUpdated(fn(Forms\Set $set) => $set('specific_muscle', null)) // Limpia el segundo campo si cambias el primero
                    ->required(),

                // SELECT 2: MÚSCULO ESPECÍFICO (Dependiente)
                Forms\Components\Select::make('specific_muscle')
                    ->label('Músculo Específico')
                    ->options(function (Get $get) {
                        $group = $get('muscle_group'); // Obtiene lo que elegiste arriba
                        if (!$group) {
                            return [];
                        }
                        // Devuelve solo los sub-músculos de esa categoría
                        return array_combine(
                            Exercise::MUSCLE_GROUPS[$group],
                            Exercise::MUSCLE_GROUPS[$group]
                        );
                    })
                    ->required(),

                //SELECT 3: EQUIPAMMIENTO
                Forms\Components\Select::make('equipment')
                    ->label('Equipamiento')
                    ->options([
                        'ninguno' => 'Peso Corporal (Sin equipo)',
                        'mancuernas' => 'Mancuernas',
                        'barra' => 'Barra Olímpica/Z',
                        'maquina' => 'Máquina',
                        'polea' => 'Polea / Cable',
                        'ligas' => 'Ligas de Resistencia',
                    ])
                    ->required(),

                //SUBIR IMAGEN
                Forms\Components\FileUpload::make('image_path')
                    ->label('Imagen o GIF Demostrativo')
                    ->image()
                    ->imageEditor() // Permite recortar la imagen ahí mismo
                    ->directory('exercises') // Carpeta donde se guardarán
                    ->columnSpanFull(),

                Forms\Components\Textarea::make('details')
                    ->label('Detalle Técnico (Opcional)')
                    ->placeholder('Escribe consejos sobre la técnica, respiración, etc.')
                    ->rows(3)
                    ->columnSpanFull(), // Ocupa todo el ancho

                Forms\Components\TextInput::make('video_url')
                    ->label('Video Explicativo (YouTube) (Opcional)')
                    ->url() // Valida automáticamente que el texto sea una URL válida
                    ->suffixIcon('heroicon-m-video-camera') // Pone un icono de cámara al final
                    ->placeholder('https://www.youtube.com/watch?v=...')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // 1. Columna de Imagen (Redonda)
                Tables\Columns\ImageColumn::make('image_path')
                    ->label('Imagen')
                    ->circular(),

                // 2. Nombre del Ejercicio
                Tables\Columns\TextColumn::make('name')
                    ->label('Ejercicio')
                    ->searchable() // Habilita la barra de búsqueda
                    ->sortable()
                    ->weight('bold'), // Letra negrita

                // 3. Grupo Muscular (Como etiqueta de color)
                Tables\Columns\TextColumn::make('muscle_group')
                    ->label('Zona')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Piernas' => 'danger',   // Rojo
                        'Brazos' => 'warning',   // Amarillo
                        'Espalda' => 'info',     // Azul
                        'Pecho' => 'success',    // Verde
                        'Cardio' => 'gray',
                        default => 'primary',
                    })
                    ->sortable(),

                // 4. Músculo Específico
                Tables\Columns\TextColumn::make('specific_muscle')
                    ->label('Músculo')
                    ->searchable(),

                // 5. Equipamiento
                Tables\Columns\TextColumn::make('equipment')
                    ->label('Equipo')
                    ->formatStateUsing(fn(string $state): string => ucfirst($state)) // Pone la primera letra mayúscula
                    ->sortable(),


                // Agregamos una columna interactiva para marcar favoritos directamente en la tabla
                Tables\Columns\ToggleColumn::make('is_favorite')
                    ->label('Favorito')
                    ->onColor('warning') // Color amarillo/dorado
                    ->offColor('gray'),

                //Video
                Tables\Columns\IconColumn::make('video_url')
                    ->label('Video')
                    ->icon('heroicon-o-play-circle')
                    ->color('danger') // Rojo tipo YouTube
                    ->url(fn ($record) => $record->video_url)
                    ->openUrlInNewTab() // Abre en otra pestaña al hacer clic
                    ->getStateUsing(fn($record) => $record->video_url ? 'heroicon-o-play-circle' : null), // Solo muestra icono si hay link


            ])
            ->filters([
                // 1. FILTRO: Grupo Muscular (Dropdown)
                Tables\Filters\SelectFilter::make('muscle_group')
                    ->label('Grupo muscular')
                    ->options(array_combine(array_keys(\App\Models\Exercise::MUSCLE_GROUPS), array_keys(\App\Models\Exercise::MUSCLE_GROUPS))),

                // 2. FILTRO: Equipo (Dropdown)
                Tables\Filters\SelectFilter::make('equipment')
                    ->label('Equipo')
                    ->options([
                        'ninguno' => 'Peso Corporal',
                        'mancuernas' => 'Mancuernas',
                        'barra' => 'Barra',
                        'maquina' => 'Máquina',
                        'polea' => 'Polea',
                        'ligas' => 'Ligas',
                    ]),

                // 3. FILTRO: Favoritos (Botón/Toggle)
                Tables\Filters\Filter::make('is_favorite')
                    ->label('★ Favoritos')
                    ->query(fn(Builder $query): Builder => $query->where('is_favorite', true))
                    ->toggle(), // Esto hace que se vea como un botón de encendido/apagado
            ])
            // --- AQUÍ ESTÁ LA MAGIA VISUAL ---
            ->filtersLayout(FiltersLayout::AboveContent) // Pone los filtros arriba de la tabla
            ->filtersFormColumns(4) // Los organiza en 4 columnas (para que quepan horizontales)

            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListExercises::route('/'),
            'create' => Pages\CreateExercise::route('/create'),
            'edit' => Pages\EditExercise::route('/{record}/edit'),
        ];
    }
}
