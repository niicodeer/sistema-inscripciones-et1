<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AjustesResource\Pages;
use App\Filament\Resources\AjustesResource\RelationManagers;
use App\Models\Ajustes;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AjustesResource extends Resource
{
    protected static ?string $model = Ajustes::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Inscripción')
                ->schema([
                    Forms\Components\DatePicker::make('fecha_inscripcion')
                    ->label('Fecha de Inscripción'),
                    Forms\Components\TimePicker::make('hora_inscripcion')
                    ->label('Hora de Inscripción'),
                    Forms\Components\Toggle::make('habilitar_inscripcion')
                    ->label('Habilitar Inscripción')
                ]),
                Section::make('Preinscripción')
                ->schema([
                    Forms\Components\DatePicker::make('fecha_preinscripcion')
                    ->label('Fecha de Preinscripción'),
                    Forms\Components\TimePicker::make('hora_preinscripcion')
                    ->label('Hora de Preinscripción'),
                    Forms\Components\Toggle::make('habilitar_preinscripcion')
                    ->label('Habilitar Preinscrición')
                ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('fecha_inscripcion'),
                Tables\Columns\TextColumn::make('hora_inscripcion'),
                Tables\Columns\TextColumn::make('fecha_preinscripcion'),
                Tables\Columns\TextColumn::make('hora_preinscripcion'),
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
            'index' => Pages\ListAjustes::route('/'),
            'create' => Pages\CreateAjustes::route('/create'),
            'edit' => Pages\EditAjustes::route('/{record}/edit'),
        ];
    }
}
