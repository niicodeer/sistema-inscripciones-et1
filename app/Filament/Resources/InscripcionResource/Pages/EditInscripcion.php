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
        $cursoNuevo = Curso::find($this->data['curso_id']);
        $cursoAnterior = Curso::find($this->record['curso_id']);
        if ($cursoNuevo->id === $cursoAnterior->id && ($this->data['aceptado'] === "0" && $this->record['aceptado'] === 1)) {
            $cursoAnterior->cantidad_alumnos--;
            $cursoAnterior->save();
        }
        if ($this->data['aceptado'] === "1" || $this->data['aceptado'] === 1) {
            if ($cursoNuevo->cantidad_alumnos < $cursoNuevo->cantidad_maxima) {
                if($cursoNuevo->id != $cursoAnterior->id){
                    $cursoAnterior->cantidad_alumnos--;
                }
                $cursoNuevo->cantidad_alumnos++;
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
