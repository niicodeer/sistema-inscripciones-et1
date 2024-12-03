<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EstudianteResource\Pages;
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
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
//use InscripcionesRelationManager;

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
                    ->minLength(11)
                    ->maxLength(11)
                    ->unique(ignoreRecord: true),
                TextInput::make('nombre')
                    ->required()
                    ->minLength(3)
                    ->maxLength(50),
                TextInput::make('apellido')
                    ->required()
                    ->minLength(3)
                    ->maxLength(50),
                TextInput::make('email')
                    ->required()
                    ->email()
                    ->maxLength(100),
                TextInput::make('telefono')
                    ->required()
                    ->maxLength(15)
                    ->tel(),
                Select::make('genero')
                    ->required()
                    ->options([
                        'Femenino' => 'Femenino',
                        'Masculino' => 'Masculino',
                        'Otro' => 'Otro'
                    ]),
                DatePicker::make('fecha_nac')
                    ->required()
                    ->format('Y-m-d')
                    ->displayFormat('d/m/Y')
                    ->label('Fecha de nacimiento'),
                Select::make('tutor_id')
                    ->relationship('tutor', 'nombre')
                    ->label('Tutor')
                    ->nullable(),
                Radio::make('es_alumno')
                    ->boolean()
                    ->default(true)
                    ->inline()
                    ->label('¿Es alumno actualmente?'),
                Fieldset::make('Más datos')
                    ->relationship('dato')
                    ->schema([
                        TextInput::make('departamento')
                            ->required()
                            ->label('Departamento'),
                        TextInput::make('localidad')
                            ->required(),
                        TextInput::make('barrio')
                            ->maxLength(100),
                        Select::make('medio_transporte')
                            ->multiple()
                            ->options([
                                'colectivo' => 'Colectivo',
                                'caminando' => 'Caminando',
                                'bicicleta' => 'Bicicleta',
                                'auto' => 'Auto',
                                'moto' => 'Moto',
                                'otro' => 'Otro'
                            ])
                            ->label('Medio de transporte'),
                        TextInput::make('calle')
                            ->maxLength(100),
                        TextInput::make('numeracion')
                            ->numeric()
                            ->label('Número'),
                        TextInput::make('piso'),
                        Radio::make('obra_social')
                            ->boolean()
                            ->inline()
                            ->label('¿Tiene obra social?'),
                        TextInput::make('nombre_obra_social')
                            ->maxLength(100)
                            ->label('Nombre de la obra social'),
                        TextInput::make('lugar_nacimiento')
                            ->maxLength(50)
                            ->label('Lugar de nacimiento'),
                        DatePicker::make('fecha_ingreso')
                            ->format('Y-m-d')
                            ->displayFormat('d/m/Y')
                            ->label('Fecha de ingreso'),
                        Select::make('convivencia')
                            ->multiple()
                            ->options([
                                'madre' => 'Madre',
                                'padre' => 'Padre',
                                'hermanos' => 'Hermanos',
                                'abuelos' => 'Abuelos',
                                'tíos' => 'Tíos',
                                'otros' => 'Otros'
                            ])
                            ->required()
                            ->label('Convive con'),
                    ]),
                    Fieldset::make('Datos tutor')
                    ->relationship('tutor')
                    ->schema([
                        TextInput::make('cuil')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->minLength(11)
                            ->maxLength(11),
                        TextInput::make('nombre')
                            ->required()
                            ->minLength(3)
                            ->maxLength(50),
                        TextInput::make('apellido')
                            ->required()
                            ->minLength(3)
                            ->maxLength(50),
                        TextInput::make('email')
                            ->required()
                            ->email()
                            ->maxLength(100),
                        TextInput::make('telefono')
                            ->required()
                            ->maxLength(15)
                            ->tel(),
                        Select::make('parentezco')
                            ->required()
                            ->options([
                                'Madre' => 'Madre',
                                'Padre' => 'Padre',
                                'Abuelo/a' => 'Abuelo/a',
                                'Tío/a' => 'Tío/a',
                                'Tutor/a' => 'Tutor/a',
                                'Otro' => 'Otro'
                            ]),
                        TextInput::make('ocupacion')
                            ->required()
                            ->maxLength(30),
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
                    Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()->after(function ($record) {
                    $record->deleted_by=Auth::id();
                    $record->save();
                }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->after(function ($action, $records) {
                        foreach ($records as $record) {
                            $record->deleted_by = Auth::id();
                            $record->save();
                        }
                    }),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make()->after(function ($action, $records) {
                        foreach ($records as $record) {
                            $record->deleted_by = null;
                            $record->save();
                        }
                    }),
                ])
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //InscripcionesRelationManager::class,
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
