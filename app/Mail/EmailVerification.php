<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailVerification extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $name;
    public $message;
    public $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $name, $message, $url)
    {
        // OOP 

        $this->email = $email;
        $this->name = $name;
        $this->message = $message;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.send_verification', ['email' => $this->email, 'message' => $this->message, 'name' => $this->name, 'token' => $this->url]);
    }
}
