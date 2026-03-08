<?php

namespace App\Mail;

use App\Models\Commande;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CommandeConfirmee extends Mailable
{
    use Queueable, SerializesModels;

    public Commande $commande;

    public function __construct(Commande $commande)
    {
        $this->commande = $commande;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'KEYZONE - Confirmation de commande #' . $this->commande->numero_commande,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.commande-confirmee',
        );
    }
}
