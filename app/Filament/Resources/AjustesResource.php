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

    protected static ?string $navigationIcon = 'heroicon-o-wrench';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Inscripción')
                ->schema([
                    Forms\Components\Toggle::make('habilitar_inscripcion')
                    ->default(false)
                    ->label('Habilitar Inscripción')
                    ->live(),
                    Forms\Components\DatePicker::make('fecha_inscripcion')
                    ->label('Fecha de Inscripción')
                    ->disabled(function (Forms\Get $get){
                        return $get ('habilitar_inscripcion') == false;
                    }),
                    Forms\Components\TimePicker::make('hora_inscripcion')
                    ->label('Hora de Inscripción')
                    ->seconds(false)
                    ->disabled(function (Forms\Get $get){
                        return $get ('habilitar_inscripcion') == false;
                    }),
                ])
                ->columnSpan(1),
                Section::make('Preinscripción')
                ->schema([
                    Forms\Components\Toggle::make('habilitar_preinscripcion')
                    ->default(false)
                    ->label('Habilitar Preinscrición')
                    ->live(),
                    Forms\Components\DatePicker::make('fecha_preinscripcion')
                    ->label('Fecha de Preinscripción')
                    ->disabled(function (Forms\Get $get){
                        return $get ('habilitar_preinscripcion') == false;
                    }),
                    Forms\Components\TimePicker::make('hora_preinscripcion')
                    ->label('Hora de Preinscripción')
                    ->seconds(false)
                    ->disabled(function (Forms\Get $get){
                        return $get ('habilitar_preinscripcion') == false;
                    }),
                ])
                ->columnSpan(1),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('fecha_inscripcion')
                ->label('Fecha de Inscripción')
                ->date('d-m-Y'),
                Tables\Columns\TextColumn::make('hora_inscripcion')
                ->label('Hora de Inscripción')
                ->time('G:i'),
                Tables\Columns\TextColumn::make('fecha_preinscripcion')
                ->date('d-m-Y')
                ->label('Fecha de Preinscripción'),
                Tables\Columns\TextColumn::make('hora_preinscripcion')
                ->label('Hora de Inscripción')
                ->time('G:i'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->url(null),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
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
