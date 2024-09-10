<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CarritoPresupuesto extends Mailable
{
    use Queueable, SerializesModels;

    public $cartItems;
    public $carritoinfo;
    public $role;
    public $cliente;

    public function __construct($cartItems, $carritoinfo, $role, $cliente)
    {
        $this->cartItems = $cartItems;
        $this->carritoinfo = $carritoinfo;
        $this->role = $role;
        $this->cliente = $cliente;
    }

    public function build()
    {
        return $this->view('emails.cart')
                    ->subject('Resumen de tu Carrito')
                    ->with([
                        'cartItems' => $this->cartItems,
                        'carritoinfo' => $this->carritoinfo,
                        'role' => $this->role,
                        'cliente' => $this->cliente,  // Pasamos el cliente a la vista
                    ]);
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
