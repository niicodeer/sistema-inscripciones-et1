<?php

namespace App\Filament\Resources\AjustesResource\Pages;

use App\Filament\Resources\AjustesResource;
use Exception;
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
                ->icon('heroicon-o-archive-box-arrow-down')
                ->action(function () {
                    $databaseName = env('DB_DATABASE'); // Nombre de la base de datos desde .env
                    $userName = env('DB_USERNAME'); // Usuario de la base de datos
                    $password = env('DB_PASSWORD'); // Contraseña de la base de datos
                    $host = env('DB_HOST', '127.0.0.1'); // Host de la base de datos
                    $port = env('DB_PORT', '3306'); // Puerto de la base de datos
                    $dumpBinaryPath = 'C:/laragon/bin/mysql/mysql-8.0.30-winx64/bin/mysqldump'; 
                    $storagePath = 'C:\laragon\www\gitProyecto\storage\app\backups';
                    $backupName = 'backup'.time().'.mysql';
                    try {
                    shell_exec($dumpBinaryPath.' -u '.$userName.' '.$databaseName. ' > '.$storagePath.'/'.$backupName);
                    Notification::make()
                    ->color('success')
                    ->title('Backup creado exitosamente.')
                    ->icon('heroicon-o-check')
                    ->send();
                    } catch (Exception $e){
                        return Notification::make()
                        ->color('danger')
                        ->icon('heroicon-o-exclamation-circle')
                        ->title($e->getMessage())
                        ->send();
                    }
                })
                ,
        ];
    }
}
