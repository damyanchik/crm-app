<?php

declare(strict_types=1);

namespace App\Mailers;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OfferMailer extends Mailable
{
    use Queueable, SerializesModels;

    private object $offer;
    private string $note;

    public function __construct(object $offer, string $note)
    {
        $this->offer = $offer;
        $this->note = $note;
    }

    public function build()
    {
        //przekazanie wymaganych rzeczy w arrayce
        return $this->subject('Przysłano ofertę nr '.$this->offer->id)
            ->markdown('emails.offer');

        //zalaczenie emaila oraz przekazanie krotkiej notatki
    }
}
