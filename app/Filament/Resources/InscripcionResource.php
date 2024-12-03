<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InscripcionResource\Pages;
use App\Jobs\SendResultadoEmailJob;
use App\Models\Curso;
use App\Models\Estudiante;
use App\Models\Inscripcion;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class InscripcionResource extends Resource
{

    protected static ?string $model = Inscripcion::class;

    protected static ?string $navigationLabel = 'Inscripciones';

    protected static ?string $slug = 'Inscripciones';

    protected static ?string $navigationIcon = 'heroicon-o-document-check';

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
                    ->searchable()
                    ->required(),

                Select::make('curso_inscripto')
                    ->options([
                        'Primer año' => 'Primer Año',
                        'Segundo año' => 'Segundo Año',
                        'Tercer año' => 'Tercer Año',
                        'Cuarto año' => 'Cuarto Año',
                        'Quinto año' => 'Quinto Año',
                        'Sexto año' => 'Sexto Año',
                    ])
                    ->required()
                    ->reactive()
                    ->live()
                    ->afterStateUpdated(function ($set) {
                        // para vaciar los campos 'modalidad' y 'curso_id' cuando se cambia el valor
                        $set('modalidad', null);
                        $set('curso_id', null);
                    }),

                Select::make('turno')
                    ->options([
                        'mañana' => 'Mañana',
                        'tarde' => 'Tarde'
                    ])
                    ->required(),     

                Select::make('modalidad')
                    ->options([
                        'Informática' => 'Informática',
                        'Economía' => 'Economía',
                        'Industria' => 'Industria'
                    ])
                    ->disabled(fn (callable $get) => !in_array($get('curso_inscripto'), ['Tercer año', 'Cuarto año', 'Quinto año', 'Sexto año']))
                    ->reactive()
                    ->afterStateUpdated(function ($set, $get) {
                        if (!in_array($get('curso_inscripto'), ['Tercer año', 'Cuarto año', 'Quinto año', 'Sexto año'])) {
                            $set('modalidad', null);
                        }
                    }),

                TextInput::make('escuela_proviene')
                    ->label('Escuela de procedencia')
                    ->maxLength(100),
                Select::make('condicion_alumno')
                    ->options([
                        'ingresante' => 'Ingresante',
                        'regular' => 'Regular',
                        'traspaso' => 'Traspaso',
                        'repitente' => 'Repitente',
                    ])
                    ->required(),         

                Select::make('curso_id')
                ->options(function (callable $get) {
                    $cursoInscripto = $get('curso_inscripto');
            
                    $mapAño = [
                        'Primer año' => 1,
                        'Segundo año' => 2,
                        'Tercer año' => 3,
                        'Cuarto año' => 4,
                        'Quinto año' => 5,
                        'Sexto año' => 6,
                    ];
            
                    if (!$cursoInscripto || !array_key_exists($cursoInscripto, $mapAño)) {
                        return [];
                    }
            
                    return Curso::where('año_curso', $mapAño[$cursoInscripto])
                        ->get()
                        ->mapWithKeys(function ($curso) {
                            return [$curso->id => "{$curso->año_curso}º {$curso->division}º"];
                        })
                        ->all();
                })
                    // ->options(Curso::all()->mapWithKeys(function ($curso) {
                    //     return [$curso->id => "{$curso->id} - {$curso->año_curso}º {$curso->division}º"];
                    // })->all())
                    ->label('Curso')
                    ->searchable()
                    ->required()
                    ->reactive(),

                DatePicker::make('fecha_inscripcion')
                    ->required()
                    ->format('Y-m-d')
                    ->displayFormat('d/m/Y')
                    ->default(now()),
                Select::make('estado_inscripcion')
                    ->options([
                        'pendiente' => 'Pendiente',
                        'no aceptado' => 'No aceptado',
                        'aceptado' => 'Aceptado',
                    ])
                    ->default('pendiente')
                    ->required()
                    ->label('Estado inscripción'),

                Radio::make('adeuda_materias')
                    ->boolean()
                    ->inline()
                    ->label('¿Adeuda materias?'),

                TextInput::make('nombre_materias')
                    ->label('Materias que adeuda')
                    ->maxLength(100)
                    ->visible(fn (callable $get) => $get('adeuda_materias')),

                Select::make('reconocimientos')
                    ->multiple()
                    ->options([
                        'familiar' => 'Familiar',
                        'merito' => 'Merito',
                        'otros' => 'Otros',
                        'ninguno' => 'Ninguno',
                    ])
                    ->label('Reconocimientos obtenidos'),

                Radio::make('papeles_presentados')
                    ->boolean()
                    ->inline()
                    ->default(false)
                    ->label('¿Presentó documentación?'),
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
                    ->sortable(['año_curso']),
                TextColumn::make('fecha_inscripcion')
                    ->sortable()
                    ->dateTime("d-M-y  H:m"),
                TextColumn::make('estado_inscripcion')
                    ->sortable()
                    ->badge()
                    ->formatStateUsing(fn(string $state): string => ucwords($state))
                    ->color(fn(string $state): string => match ($state) {
                        'pendiente' => 'warning',
                        'aceptado' => 'success',
                        'no aceptado' => 'danger',
                    })
                    ->icon(fn(string $state): ?string => match ($state) {
                        'pendiente' => 'heroicon-o-clock',
                        'aceptado' => 'heroicon-o-check-circle',
                        'no aceptado' => 'heroicon-o-x-circle',
                    }),

                IconColumn::make('papeles_presentados')
                    ->label('Papeles Presentados')
                    ->icon(fn(bool $state): string => $state ? 'heroicon-o-check-circle' : 'heroicon-o-x-circle')
                    ->color(fn(bool $state): ?string => $state ? 'success' : 'danger')
                    ->sortable(),

                IconColumn::make('email_sent_at')
                    ->label('Notificado')
                    ->icon(
                        fn($state): string => $state ? 'heroicon-o-check-circle' : 'heroicon-o-x-circle'
                    )
                    ->color(fn($state): ?string => $state ? 'success' : 'warning')
                    ->size(IconColumn\IconColumnSize::Large),
            ])
            ->filters([
                SelectFilter::make('estado_inscripcion')
                    ->options([
                        'pendiente' => 'Pendiente',
                        'no aceptado' => 'No aceptado',
                        'aceptado' => 'Aceptado',
                    ])
                    ->label('Estado inscripción'),
                SelectFilter::make('curso_id')
                    ->options(Curso::all()->mapWithKeys(function ($curso) {
                        return [$curso->id => "{$curso->id} - {$curso->año_curso}º {$curso->division}º"];
                    })->all())
                    ->label('Curso'),
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()->after(function ($record) {
                    $record->deleted_by = Auth::id();
                    $record->save();
                }),
                Action::make('Enviar mail')
                    ->visible(function (Inscripcion $record) {
                        return $record->email_sent_at == null && $record->estado_inscripcion != 'pendiente';
                    })
                    ->action(function (Inscripcion $record) {
                        SendResultadoEmailJob::dispatch($record);
                        Notification::make()
                            ->title('Proceso iniciado')
                            ->body('El proceso de envío de email ha sido iniciado.')
                            ->warning()
                            ->send();
                    })
                    ->icon('heroicon-o-paper-airplane')
                    ->color('info')
                    ->button()
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
                Tables\Actions\BulkAction::make('Imprimir PDF')
                ->label('Imprimir PDF')
                ->color('indigo')
                ->icon('heroicon-o-arrow-down-tray')
                ->action(function (Collection $records) {
                    $curso = $records->first()->curso->fullcurso; // Suponiendo que los estudiantes pertenecen al mismo curso
                    $alumnos = $records->map(function ($record) {
                        return $record->estudiante;
                    });

                    $pdf = Pdf::loadView('listados.listado-pdf', [
                        'curso' => $curso,
                        'alumnos' => $alumnos,
                    ])->setPaper('A4', 'landscape');

                    return response()->streamDownload(
                        fn() => print($pdf->output()),
                        'listado-alumnos.pdf'
                    );})
                ,
                Tables\Actions\BulkAction::make('Enviar Mails')
                    ->requiresConfirmation()
                    ->modalHeading('Confirmación de envío de correos')
                    ->modalDescription('¿Estás seguro de que deseas enviar correos a los estudiantes seleccionados?')
                    ->icon('heroicon-o-paper-airplane')
                    ->color('info')
                    ->action(
                        function (Collection $records) {
                            $totalRecords = $records->count();
                            $sentCount = 0;
                            $records->each(function (Inscripcion $record) use (&$sentCount) {
                                try {
                                    SendResultadoEmailJob::dispatch($record);
                                    $sentCount++;
                                } catch (Exception $e) {
                                    Notification::make()
                                        ->title('Error al mandar mail')
                                        ->body('Ocurrió un error al mandar el email')
                                        ->danger()
                                        ->icon('heroicon-o-envelope')
                                        ->iconColor('danger')
                                        ->send();
                                }
                            });
                            Notification::make()
                                ->title('Mails enviados')
                                ->body("Se enviaron $sentCount de $totalRecords mails con éxito.")
                                ->success()
                                ->icon('heroicon-o-envelope')
                                ->iconColor('success')
                                ->send();
                        }
                    )
                    ->deselectRecordsAfterCompletion(),
            ])
            ->checkIfRecordIsSelectableUsing(
                fn(Inscripcion $record): bool => $record->email_sent_at === null,
            );
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

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
