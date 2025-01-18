<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PontosGanhosMail extends Mailable
{
    use Queueable, SerializesModels;

    private $cliente;
    private $pontos;
    private $saldoAtual;

    /**
     * Create a new message instance.
     */
    public function __construct($cliente, $pontos, $saldoAtual)
    {
        $this->cliente = $cliente;
        $this->pontos = $pontos;
        $this->saldoAtual = $saldoAtual;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Sua pontuação foi atualizada!',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.ganho-pontos',
            with: [
                "nome" => $this->cliente->nome,
                "pontos" => $this->pontos,
                "saldoAtual" => $this->saldoAtual
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
