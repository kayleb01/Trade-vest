<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactSupport extends Mailable
{
    use Queueable, SerializesModels;

    protected $name;
    protected $email;
    protected $message;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $name, string $email, string $message)
    {
       $this->name = $name;
       $this->email = $email;
       $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.contact')->with([
            'name' => $this->name,
            'email' => $this->email,
            'message' => $this->message,
        ])
        ->subject("Client Enquiry ". '('. $this->name . ')');
    }
}
