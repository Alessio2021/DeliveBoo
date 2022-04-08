<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Mail\SendNewMail;
use Illuminate\Support\Facades\Mail;

class sendNewMail extends Mailable
{
    use Queueable, SerializesModels;
    public $lead;
    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($_lead, $_data)
    {
        $this->lead = $_lead;
        $this->data = $_data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.newEmail');
    }
}
