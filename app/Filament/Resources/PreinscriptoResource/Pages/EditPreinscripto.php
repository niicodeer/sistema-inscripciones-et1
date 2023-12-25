<?php

namespace App\Filament\Resources\PreinscriptoResource\Pages;

use App\Filament\Resources\PreinscriptoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPreinscripto extends EditRecord
{
    protected static string $resource = PreinscriptoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}
