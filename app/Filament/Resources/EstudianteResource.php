<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EstudianteResource\Pages;
use App\Filament\Resources\EstudianteResource\RelationManagers\InscripcionesRelationManager;
use App\Models\Estudiante;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


class EstudianteResource extends Resource
{
    protected static ?string $model = Estudiante::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('cuil')
                    ->required()
                    ->minLength(3)
                    ->maxLength(20),
                TextInput::make('nombre')
                    ->required(),
                TextInput::make('apellido')
                    ->required(),
                TextInput::make('email')
                    ->required()
                    ->email(),
                Select::make('genero')
                    ->required()
                    ->options([
                        'femenino' => 'Femenino',
                        'masculino' => 'Masculino',
                        'otro' => 'Otro'
                    ]),
                DatePicker::make('fecha_nac')
                    ->label('Fecha Nacimiento'),
                Radio::make('es_alumno')
                    ->options([
                        0 => 'No es alumno',
                        1 => 'Si es alumno',
                    ])
                    ->label('¿Es Alumno?'),
                Fieldset::make('Más datos')
                    ->relationship('dato')
                    ->schema([
                        TextInput::make('calle'),
                        TextInput::make('numeracion'),
                        TextInput::make('piso'),
                        TextInput::make('barrio'),
                        TextInput::make('medio_transporte')
                            ->label('Medio de transporte'),
                        TextInput::make('lugar_nacimiento')
                            ->label('Lugar de nacimiento'),
                        TextInput::make('convivencia')
                            ->label('Convive con'),
                        Radio::make('obra_social')
                            ->options([
                                0 => 'No',
                                1 => 'Si',
                            ]),
                        TextInput::make('nombre_obra_social'),
                        /* TextInput::make('escuela_proviene')
                            ->label('Escuela de la que proviente'), */
                        DatePicker::make('fecha_ingreso'),
                    ]),
                Fieldset::make('Datos tutor')
                    ->relationship('tutor')
                    ->schema([
                        TextInput::make('cuil'),
                        TextInput::make('email'),
                        TextInput::make('parentezco'),
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
            ->modifyQueryUsing(fn (Builder $query) => $query->where('es_alumno', true))
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
                TextColumn::make('genero')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('fecha_nac')
                    ->label('Fecha Nacimiento')
                    ->dateTime('d-M-y')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('es_alumno')
                    ->options([
                        '0' => 'No es alumno',
                        '1' => 'Es alumno',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ])
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
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
