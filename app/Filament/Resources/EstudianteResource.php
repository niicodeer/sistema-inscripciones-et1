<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EstudianteResource\Pages;
use App\Filament\Resources\EstudianteResource\RelationManagers\InscripcionesRelationManager;
use App\Models\Estudiante;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Radio;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


class EstudianteResource extends Resource
{
    protected static ?string $model = Estudiante::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $activeNavigationIcon = 'heroicon-o-user-group';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('cuil')
                    ->required()
                    ->minLength(3)
                    ->maxLength(20),
                TextInput::make('nombre'),
                TextInput::make('apellido'),
                TextInput::make('email'),
                DatePicker::make('fecha_nac')
                    ->label('Fecha Nacimiento'),
                Radio::make('esAlumno')
                    ->options([
                        0 => 'No es alumno',
                        1 => 'Si es alumno',
                    ])
                    ->label('¿Es Alumno?'),
                Fieldset::make('Más datos')
                    ->relationship('dato')
                    ->schema([
                        TextInput::make('calle'),
                        TextInput::make('medio_transporte')
                            ->label('Medio de transporte'),
                        TextInput::make('lugar_nacimiento')
                            ->label('Lugar de nacimiento'),
                        TextInput::make('convivencia')
                            ->label('Convive con'),
                        TextInput::make('obra_social'),
                        /* TextInput::make('escuela_proviene')
                            ->label('Escuela de la que proviente'), */
                        DatePicker::make('fecha_ingreso'),
                    ]),
                Fieldset::make('Datos tutor')
                    ->relationship('tutor')
                    ->schema([
                        TextInput::make('cuil'),
                        TextInput::make('nombre'),
                        TextInput::make('apellido'),
                        TextInput::make('telefono'),
                        TextInput::make('ocupacion'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('cuil')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('nombre')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('apellido')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('fecha_nac')
                    ->dateTime('d-M-y')
                    ->sortable(),
                ToggleColumn::make('esAlumno')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('esAlumno')
                    ->options([
                        '0' => 'No es alumno',
                        '1' => 'Es alumno',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            InscripcionesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEstudiantes::route('/'),
            'create' => Pages\CreateEstudiante::route('/create'),
            'edit' => Pages\EditEstudiante::route('/{record}/edit'),
        ];
    }
}
