<?php

namespace App\Jobs;

use App\Events\ResultadoInscripcionEnviada;
use App\Mail\ResultadoInscripcionMail;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;


class SendResultadoEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $record;
    public $tries = 3;

    public function __construct($record)
    {
        $this->record = $record;

    }

    public function handle(): void
    {
        try {
            Mail::to($this->record->estudiante->email)
                ->send(new ResultadoInscripcionMail($this->record));

            $this->record->email_sent_at = now();
            $this->record->save();
        } catch (Exception $e) {
            Log::error('[SendResultadoEmailJob] Error al enviar el correo: ' . $e);
            throw $e;
        }
    }

    public function failed(Exception $exception)
    {
        Log::error('[SendResultadoEmailJob] El Job de envío de correo falló: ' . $exception->getMessage());
        $this->record->email_failed_at = now();
        $this->record->save();
    }
}
