<?php

namespace App\Filament\Resources\AjustesResource\Pages;

use App\Filament\Resources\AjustesResource;
use Exception;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

use function PHPUnit\Framework\throwException;

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
                    $databaseName = env('DB_DATABASE');
                    $userName = env('DB_USERNAME');
                    $password = env('DB_PASSWORD');
                    $host = env('DB_HOST', '127.0.0.1');
                    $port = env('DB_PORT', '3306');
                    $dumpBinaryPath = env('DUMP_BINARY_PATH');
                    $storagePath = env('BACKUP_STORAGE_PATH');
                    $backupName = env('BACKUP_PREFIX') . time() . '.mysql';
                    try {
                        shell_exec($dumpBinaryPath . ' -u ' . $userName . ' -h ' . $host . ' --port ' . $port . ' ' . $databaseName . ' > ' . $storagePath . '/' . $backupName);

                        Notification::make()
                            ->color('success')
                            ->title('Backup creado exitosamente.')
                            ->icon('heroicon-o-check')
                            ->iconColor('success')
                            ->send();
                    } catch (Exception $e) {
                        Log::error('Error al realizar el backup de la base de datos: ' . $e->getMessage());
                        return Notification::make()
                            ->color('danger')
                            ->icon('heroicon-o-exclamation-circle')
                            ->iconColor('danger')
                            ->title($e->getMessage())
                            ->send();
                    }
                }),
        ];
    }
}
