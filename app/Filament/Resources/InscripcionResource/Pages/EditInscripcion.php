<?php

namespace App\Filament\Resources\InscripcionResource\Pages;

use App\Filament\Resources\InscripcionResource;
use App\Models\Curso;
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
        if (($this->data['aceptado'] === (1 | "1") && $this->record['curso_id'] != $this->data['curso_id']) || ($this->record['curso_id'] === $this->data['curso_id'] && $this->record['aceptado'] != $this->data['aceptado'])) {
            $cursoNuevo = Curso::find($this->data['curso_id']);
            $cursoAnterior = Curso::find($this->record['curso_id']);
            if ($cursoNuevo->cantidad_alumnos < $cursoNuevo->cantidad_maxima) {
                $cursoNuevo->cantidad_alumnos++;
                $cursoAnterior->cantidad_alumnos--;
                $this->data['aceptado'] = 1;
                $cursoNuevo->save();
                $cursoAnterior->save();
            } else {
                $this->data['aceptado'] = 0;
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
