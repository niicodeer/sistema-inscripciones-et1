<?php

namespace App\Filament\Resources\AjustesResource\Pages;

use App\Filament\Resources\AjustesResource;
use Carbon\Carbon;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Validation\ValidationException;

class EditAjustes extends EditRecord
{
    protected static string $resource = AjustesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            /* Actions\DeleteAction::make(), */];
    }

    protected function beforeSave(): void
    {
        $data = $this->form->getState();
        $errorMessage = null;
        if ($data['habilitar_preinscripcion']) {
            $inicioPreinscripcion = Carbon::parse($data['inicio_fecha_preinscripcion'] . ' ' . $data['inicio_hora_preinscripcion']);
            $finPreinscripcion = Carbon::parse($data['fin_fecha_preinscripcion'] . ' ' . $data['fin_hora_preinscripcion']);
            if ($finPreinscripcion->lessThanOrEqualTo($inicioPreinscripcion)) {
                $this->data['fin_fecha_preinscripcion'] = $this->record['fin_fecha_preinscripcion'];
                $this->data['fin_hora_preinscripcion'] = $this->record['fin_hora_preinscripcion'];
                $errorMessage = 'La Fecha y Hora de Fin deben ser posteriores a la Fecha y Hora de Inicio.';
            }
        }
        if ($data['habilitar_inscripcion']) {
            $inicioInscripcion = Carbon::parse($data['inicio_fecha_inscripcion'] . ' ' . $data['inicio_hora_inscripcion']);
            $finInscripcion = Carbon::parse($data['fin_fecha_inscripcion'] . ' ' . $data['fin_hora_inscripcion']);
            if ($finInscripcion->lessThanOrEqualTo($inicioInscripcion)) {
                $this->data['fin_fecha_inscripcion'] = $this->record['fin_fecha_inscripcion'];
                $this->data['fin_hora_inscripcion'] = $this->record['fin_hora_inscripcion'];
                $errorMessage = 'La Fecha y Hora de Fin deben ser posteriores a la Fecha y Hora de Inicio.';
            }
        }
        if ($errorMessage) {
            Notification::make()
                ->title($errorMessage)
                ->danger()
                ->send();
            $this->halt();
        }
    }
}
