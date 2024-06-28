<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $emailMessage;

    public function __construct($name, $email, $emailMessage)
    {
        $this->name = $name;
        $this->email = $email;
        $this->emailMessage = $emailMessage;
    }

    public function build()
    {
        return $this->subject('Thông báo về liên hệ mới từ website')
            ->view('pages.email.contact')
            ->with([
                'name' => $this->name, 
                'email' => $this->email, 
                'emailMessage' => $this->emailMessage,
            ]);
    }
}
