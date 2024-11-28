<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $number_order;
    public $status;
    public $name;
    public $email;


    /**
     * Create a new message instance.
     */
    public function __construct($number_order, $status, $name, $email)
    {
        $this->number_order = $number_order;
        $this->status = $status;
        $this->name = $name;
        $this->email = $email;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Miguitas - Estado ' . $this->status . ' de tu pedido',
        );
    }

    public function build()
    {
        return $this->subject("Miguitas - Estado " . $this->status . " de tu pedido")
            ->view('store.email.order-status')
            ->with([
                'number_order' => $this->number_order,
                'status' => $this->status,
                'name' => $this->name,
                'email' => $this->email,
            ]);
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'store.email.order-status',
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