<?php

namespace App\Filament\Resources\AjustesResource\Pages;

use App\Filament\Resources\AjustesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAjustes extends EditRecord
{
    protected static string $resource = AjustesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            /* Actions\DeleteAction::make(), */
        ];
    }
}
