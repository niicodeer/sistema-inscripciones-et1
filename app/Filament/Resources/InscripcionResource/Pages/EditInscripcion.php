<?php

namespace App\Filament\Resources\InscripcionResource\Pages;

use App\Filament\Resources\InscripcionResource;
use App\Models\Curso;
use App\Models\Estudiante;
use App\Models\Inscripcion;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class EditInscripcion extends EditRecord
{
    protected static string $resource = InscripcionResource::class;


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
        if (
            $cursoNuevo->id === $cursoAnterior->id &&
            (($this->data['estado_inscripcion'] === "pendiente" || $this->data['estado_inscripcion'] === "no aceptado") &&
                $this->record['estado_inscripcion'] === "aceptado")
            //Deberia cambiaar el estado de es_alumno a 0??
        ) {
            $cursoAnterior->cantidad_alumnos--;
            $cursoAnterior->save();
        }
        if ($this->data['estado_inscripcion'] === "aceptado") {
            if ($cursoNuevo->cantidad_alumnos < $cursoNuevo->cantidad_maxima) {
                if ($cursoNuevo->id != $cursoAnterior->id) {
                    $cursoAnterior->cantidad_alumnos--;
                }
                $cursoNuevo->cantidad_alumnos++;
                $this->data['estado_inscripcion'] = "aceptado";
                $estudiante->es_alumno = 1;
                $estudiante->save();
                $cursoNuevo->save();
                $cursoAnterior->save();
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
