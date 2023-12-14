<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InscripcionResource\Pages;
use App\Filament\Resources\InscripcionResource\RelationManagers;
use App\Models\Estudiante;
use App\Models\Inscripcion;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
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
                Toggle::make('aceptado'),
                DatePicker::make('fechaInscripcion')
                ->format('d-M-y'),
                TextInput::make('estudiante.nombre')
            ]);
    }

    public static function table(Table $table): Table
    {
        
        return $table
            ->columns([
                ToggleColumn::make('aceptado')
                ->sortable(),
                TextColumn::make('fechaInscripcion')
                ->sortable(),
                TextColumn::make('estudiante.fullname')
                ->searchable()
                ->sortable(),
                
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
            'index' => Pages\ListInscripcions::route('/'),
            'create' => Pages\CreateInscripcion::route('/create'),
            'edit' => Pages\EditInscripcion::route('/{record}/edit'),
        ];
    }
}
