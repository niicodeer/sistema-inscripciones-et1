<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InscripcionResource\Pages;
use App\Filament\Resources\InscripcionResource\RelationManagers;
use App\Models\Curso;
use App\Models\Estudiante;
use App\Models\Inscripcion;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


class InscripcionResource extends Resource
{

    protected static ?string $model = Inscripcion::class;

    protected static ?string $navigationLabel = 'Inscripciones';

    protected static ?string $slug = 'Inscripciones';

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $activeNavigationIcon = 'heroicon-o-document-check';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('estudiante_id')
                    ->options(Estudiante::all()->mapWithKeys(function ($estudiante) {
                        return [$estudiante->id => "{$estudiante->cuil} - {$estudiante->nombre} {$estudiante->apellido}"];
                    })->all())
                    ->label('Estudiante')
                    ->hiddenOn('edit')
                    ->searchable(),
                Select::make('curso_id')
                    ->options(Curso::all()->mapWithKeys(function ($curso) {
                        return [$curso->id => "{$curso->id} - {$curso->añoCurso}º {$curso->division}º"];
                    })->all())
                    ->label('Curso')
                    ->searchable(),
                DatePicker::make('fechaInscripcion'),
                Radio::make('aceptado')
                    ->options([
                        0 => 'No aceptado',
                        1 => 'Aceptado',
                    ])
                    ->label('Estado inscripción')
            ]);
    }

    public static function table(Table $table): Table
    {

        return $table
            ->columns([
                TextColumn::make('estudiante.cuil')
                    ->label('CUIL')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('estudiante.fullname')
                    ->searchable(['nombre', 'apellido']),
                TextColumn::make('curso.fullcurso')
                    ->sortable(['añoCurso']),
                TextColumn::make('fechaInscripcion')
                    ->sortable()
                    ->dateTime("d-M-y  H:m"),
                ToggleColumn::make('aceptado')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('aceptado')
                    ->options([
                        '0' => 'No aceptado',
                        '1' => 'Aceptado',
                    ])
                    ->label('Estado inscripción'),
                SelectFilter::make('curso_id')
                    ->options(Curso::all()->mapWithKeys(function ($curso) {
                        return [$curso->id => "{$curso->id} - {$curso->añoCurso}º {$curso->division}º"];
                    })->all())
                    ->label('Curso')
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
            'index' => Pages\ListInscripcions::route('/'),
            'create' => Pages\CreateInscripcion::route('/create'),
            'edit' => Pages\EditInscripcion::route('/{record}/edit'),
        ];
    }
}
