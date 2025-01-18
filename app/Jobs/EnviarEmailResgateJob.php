<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Mail\BrindeResgatadoMail;

class EnviarEmailResgateJob implements ShouldQueue
{
    use Queueable, Dispatchable, InteractsWithQueue, SerializesModels;

    private $cliente;
    private $brinde;

    /**
     * Create a new job instance.
     */
    public function __construct($cliente, $brinde)
    {
        $this->cliente = $cliente;
        $this->brinde = $brinde;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        try{
        Mail::to($this->cliente->email)->send(new BrindeResgatadoMail($this->cliente, $this->brinde->brinde));
        Log::info("E-mail enviado com sucesso para {$this->cliente->email}");
        } catch (\Exception $e) {
            Log::error("Erro ao enviar e-mail: " . $e->getMessage());
        }
    }
}
