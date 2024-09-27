<?php

namespace App\Filament\Resources\AjustesResource\Pages;

use App\Filament\Resources\AjustesResource;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Artisan;

class ListAjustes extends ListRecords
{
    protected static string $resource = AjustesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('backup')
                ->label('Crear Backup')
                ->action(function () {
                    Artisan::call('backup:run --only-db');
                    Notification::make('Exito');
                })
               // ->icon('heroicon-o-database')
                ,
        ];
    }
}
