<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMessageMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mailData;

    public function __construct($mailData)
    {
        $this->mailData = $mailData;
    }

    public function build()
    {
        return $this->subject('IQC Contact Message from ' . $this->mailData['name'])
        ->replyTo($this->mailData['email'], $this->mailData['name'])
        ->view('emails.contact_message');
    }
}
