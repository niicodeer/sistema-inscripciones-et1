<?php

namespace App\Filament\Resources\PreinscriptoResource\Pages;

use App\Filament\Resources\PreinscriptoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPreinscriptos extends ListRecords
{
    protected static string $resource = PreinscriptoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
