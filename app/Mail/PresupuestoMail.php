<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PresupuestoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $filePath;

    /**
     * Create a new message instance.
     */
    public function __construct($data, $filePath)
    {
        $this->data = $data;
        $this->filePath = $filePath;
    }

    /**
     * Get the message envelope.
     */
    public function envelope()
    {
        return [
            'subject' => 'Presupuesto Mail',
        ];
    }

    /**
     * Get the message content definition.
     */
    public function content()
    {
        return [
            'view' => 'emails.presupuesto', // Nombre de la vista del correo
            'with' => ['data' => $this->data] // Pasar datos a la vista
        ];
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments()
    {
        return [
            [
                'path' => $this->filePath,
                'as' => 'presupuesto-file.' . pathinfo($this->filePath, PATHINFO_EXTENSION),
                'mime' => mime_content_type($this->filePath),
            ]
        ];
    }
}
