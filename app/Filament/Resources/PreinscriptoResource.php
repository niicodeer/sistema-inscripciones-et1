<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PreinscriptoResource\Pages;
use App\Filament\Resources\PreinscriptoResource\RelationManagers;
use App\Models\Preinscripto;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class PreinscriptoResource extends Resource
{
    protected static ?string $model = Preinscripto::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-plus';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('cuil')
                    ->required()
                    ->minLength(10)
                    ->maxLength(11),
                TextInput::make('nombre')
                    ->required()
                    ->minLength(3)
                    ->maxLength(25),
                TextInput::make('apellido')
                    ->required()
                    ->minLength(2)
                    ->maxLength(25),
                TextInput::make('email')
                    ->required(),
                DatePicker::make('fecha_nac')
                    ->format('d-M-y')
                    ->label("Fecha de nacimiento")
                    ->required(),
                TextInput::make('telefono')
                    ->required(),
                Select::make('genero')
                    ->required()
                    ->options([
                        'Femenino' => 'Femenino',
                        'Masculino' => 'Masculino',
                        'Otro' => 'Otro'
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('cuil')
                    ->searchable()->sortable(),
                TextColumn::make('nombre')
                    ->searchable()->sortable(),
                TextColumn::make('apellido')
                    ->searchable()->sortable(),
                TextColumn::make('email')
                    ->searchable()->sortable(),
                TextColumn::make('genero'),
                TextColumn::make('telefono'),
                TextColumn::make('fecha_nac')
                    ->dateTime('d-M-y')
                    ->label("Fecha de nacimiento")
                    ->sortable(),
                TextColumn::make('condicion_preinscripcion')
                ->sortable(),
                TextColumn::make('created_at')
                    ->label("Fecha de preinscripcion")
                    ->dateTime("d-M-y  H:m")
                    ->sortable(),
            ])
            ->defaultSort('condicion_preinscripcion', 'asc')
            ->filters([
                SelectFilter::make('genero')
                    ->options([
                        'femenino' => 'Femenino',
                        'masculino' => 'Masculino',
                        'otro' => 'Otro'
                    ]),
                SelectFilter::make('condicion_preinscripcion')
                    ->options([
                        'alumno familiar' => 'Alumno Familiar',
                        'alumno general' => 'Alumno General',

                    ]),
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()->after(function ($record) {
                    $record->deleted_by = Auth::id();
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
                    Tables\Actions\RestoreBulkAction::make()->after(function ($action, $records) {
                        foreach ($records as $record) {
                            $record->deleted_by = null;
                            $record->save();
                        }
                    }),
                    Tables\Actions\ForceDeleteBulkAction::make(),
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
            'index' => Pages\ListPreinscriptos::route('/'),
            'create' => Pages\CreatePreinscripto::route('/create'),
            'edit' => Pages\EditPreinscripto::route('/{record}/edit'),
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
