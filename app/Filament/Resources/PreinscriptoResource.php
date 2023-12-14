<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PreinscriptoResource\Pages;
use App\Filament\Resources\PreinscriptoResource\RelationManagers;
use App\Models\Preinscripto;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PreinscriptoResource extends Resource
{
    protected static ?string $model = Preinscripto::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
                TextColumn::make('fecha_nac')
                ->dateTime('d-M-y')
                ->label("Fecha de nacimiento")->sortable(),
                TextColumn::make('created_at')
                ->label("Fecha de preinscripcion")->sortable(),
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
            'index' => Pages\ListPreinscriptos::route('/'),
            'create' => Pages\CreatePreinscripto::route('/create'),
            'edit' => Pages\EditPreinscripto::route('/{record}/edit'),
        ];
    }
}
