<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BrindeResgatadoMail extends Mailable
{
    use Queueable, SerializesModels;

    private $cliente;
    private $brinde;

    /**
     * Create a new message instance.
     */
    public function __construct($cliente, $brinde)
    {
        $this->cliente = $cliente;
        $this->brinde = $brinde;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Parabéns pelo seu novo resgate!',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.resgate-brindes',
            with: [
                'nome' => $this->cliente->nome,
                'brinde' => $this->brinde
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
