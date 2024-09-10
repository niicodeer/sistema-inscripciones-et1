<?php

namespace App\Filament\Resources\AjustesResource\Pages;

use App\Filament\Resources\AjustesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAjustes extends ListRecords
{
    protected static string $resource = AjustesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //Actions\CreateAction::make(),
        ];
    }
}
