<?php

namespace App\Filament\Resources\EstudianteResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InscripcionesRelationManager extends RelationManager
{
    protected static string $relationship = 'inscripciones';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                /* Forms\Components\TextInput::make('id')
                    ->required()
                    ->maxLength(255), */
                Select::make('curso_id')
                ->relationship('curso', 'id'),
                DatePicker::make('fechaInscripcion'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('curso_id'),
                //TextColumn::make('curso'),
                TextColumn::make('curso.añoCurso')
                ->label('Año curso'),
                TextColumn::make('curso.division')
                ->label('División curso'),
                TextColumn::make('curso.turno')
                ->label('Turno curso'),
                TextColumn::make('fechaInscripcion'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
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
}
