<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class rfqMail extends Mailable
{
    use Queueable, SerializesModels;

    public $rfq = null;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($_rfq)
    {
        $this->rfq = $_rfq;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.rfq')->with("obj", $this->rfq);
    }
}
