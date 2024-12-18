<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ShippingCostEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $number_order;
    public $name;
    public $shippingCost;

    /**
     * Create a new message instance.
     */
    public function __construct($number_order, $name, $shippingCost)
    {
        $this->number_order = $number_order;
        $this->name = $name;
        $this->shippingCost = $shippingCost;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Miguitas - Costo de envío de tu pedido',
        );
    }

    public function build()
    {
        return $this->subject("Miguitas - Costo de envío de tu pedido")
            ->view('store.email.shipping-cost')
            ->with([
                'number_order' => $this->number_order,
                'name' => $this->name,
                'shippingCost' => $this->shippingCost,
            ]);
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'store.email.shipping-cost',
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
