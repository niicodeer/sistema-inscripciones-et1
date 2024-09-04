<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CursoResource\Pages;
use App\Filament\Resources\CursoResource\RelationManagers;
use App\Models\Curso;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\Alignment;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class CursoResource extends Resource
{
    protected static ?string $model = Curso::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $activeNavigationIcon = 'heroicon-o-book-open';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('año_curso')
                    ->options([
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4',
                        '5' => '5',
                        '6' => '6',
                    ])
                    ->hiddenOn('edit')
                    ->required(),
                Forms\Components\Select::make('division')
                    ->options([
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4',
                        '5' => '5',
                        '6' => '6',

                    ])
                    ->hiddenOn('edit')
                    ->required(),
                Forms\Components\Select::make('turno')
                    ->options([
                        'Mañana' => 'Mañana',
                        'Tarde' => 'Tarde',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('cantidad_maxima')
                    ->required()
                    ->numeric()
                    ->maxValue(50)
                    ->minValue(0)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('turno')
                ->alignment(Alignment::Center)
                    ->sortable(),
                Tables\Columns\TextColumn::make('año_curso')
                ->alignment(Alignment::Center)
                    ->sortable(),
                Tables\Columns\TextColumn::make('division')
                ->alignment(Alignment::Center)
                    ->sortable(),
                Tables\Columns\TextColumn::make('cantidad_alumnos')
                    ->alignment(Alignment::Center)
                    ->badge()
                    ->color(function (string $state): string {
                        $value = (int) $state;
                        return match (true) {
                            $value >= 0 && $value <= 15 => 'success',
                            $value >= 16 && $value <= 20 => 'warning',
                            $value > 20 => 'danger',
                            default => 'gray',
                        };
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('cantidad_maxima')
                ->alignment(Alignment::Center),
            ])
            ->filters([
                SelectFilter::make('turno')
                    ->options([
                        'tarde' => 'Tarde',
                        'mañana' => 'Mañana',
                    ]),
                SelectFilter::make('año_curso')
                    ->options([
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4',
                        '5' => '5',
                        '6' => '6'
                    ]),
                SelectFilter::make('division')
                    ->options([
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4',
                        '5' => '5',
                        '6' => '6'
                    ]),
                    Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
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
            'index' => Pages\ListCursos::route('/'),
            'create' => Pages\CreateCurso::route('/create'),
            'edit' => Pages\EditCurso::route('/{record}/edit'),
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
