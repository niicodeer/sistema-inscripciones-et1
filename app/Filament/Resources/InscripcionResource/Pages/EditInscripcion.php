<?php

namespace App\Filament\Resources\InscripcionResource\Pages;

use App\Filament\Resources\InscripcionResource;
use App\Models\Curso;
use App\Models\Estudiante;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditInscripcion extends EditRecord
{
    protected static string $resource = InscripcionResource::class;
    protected bool $succesful = false;


    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function beforeSave(): void
    {

        $cursoNuevo = Curso::find($this->data['curso_id']);
        $cursoAnterior = Curso::find($this->record['curso_id']);
        $estudiante = Estudiante::find($this->data['estudiante_id']);

        // Si existe un curso anterior y es el mismo que el nuevo
        if ($cursoAnterior && $cursoNuevo->id === $cursoAnterior->id &&
            (($this->data['estado_inscripcion'] === "pendiente" || $this->data['estado_inscripcion'] === "no aceptado") &&
                $this->record['estado_inscripcion'] === "aceptado")
        ) {
            $cursoAnterior->cantidad_alumnos--;
            $cursoAnterior->save();
        }

        if ($this->data['estado_inscripcion'] === "aceptado") {
            if ($cursoNuevo->cantidad_alumnos < $cursoNuevo->cantidad_maxima) {
                // Solo decrementar el curso anterior si existe y es diferente al nuevo
                if ($cursoAnterior && $cursoNuevo->id != $cursoAnterior->id) {
                    $cursoAnterior->cantidad_alumnos--;
                    $cursoAnterior->save();
                }
                
                $cursoNuevo->cantidad_alumnos++;
                $this->data['estado_inscripcion'] = "aceptado";
                $estudiante->es_alumno = 1;
                $estudiante->save();
                $cursoNuevo->save();
                
                $this->succesful = true;
            } else {
                $this->data['estado_inscripcion'] = "pendiente";
                $errorMessage = 'No hay cupos disponibles para el curso seleccionado! Revisa el límite de alumnos por curso';
                Notification::make()
                    ->title($errorMessage)
                    ->danger()
                    ->send();
                $this->halt();
            }
        }
    }

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}
