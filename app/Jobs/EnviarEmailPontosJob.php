<?php

namespace App\Jobs;

use App\Mail\PontosGanhosMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class EnviarEmailPontosJob implements ShouldQueue
{
    use Queueable, Dispatchable, InteractsWithQueue, SerializesModels;

    public $cliente;
    public $pontos;

    /**
     * Create a new job instance.
     */
    public function __construct($cliente, $pontos)
    {
        $this->cliente = $cliente;
        $this->pontos = $pontos;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        try {
            Mail::to($this->cliente->email)->send(new PontosGanhosMail($this->cliente, $this->pontos, $this->cliente->saldo_pontos));
            Log::info("E-mail enviado com sucesso para {$this->cliente->email}");
        } catch (\Exception $e) {
            Log::error("Erro ao enviar e-mail: " . $e->getMessage());
        }
    }
}
