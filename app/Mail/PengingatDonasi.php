<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PengingatDonasi extends Mailable
{
    use Queueable, SerializesModels;

    public $donatur;

    public function __construct($donatur)
    {
        $this->donatur = $donatur;
    }

    public function build()
    {
        return $this->subject('Pengingat Donasi Rutin')
            ->view('emails.pengingat_donatur')
            ->with([
                'uuid' => $this->donatur->uuid,
                'nama' => $this->donatur->nama,
                'nominal' => $this->donatur->nominal,
                'frekuensi' => $this->donatur->frekuensi,
            ]);
    }
}
