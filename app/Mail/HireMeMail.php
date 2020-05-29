<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class HireMeMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $_name;

    public $_email;

    public $_subject;

    public $_description;

    public function __construct($name, $email, $subject, $description)
    {

        $this->_name = $name;

        $this->_email = $email;

        $this->_subject = $subject;

        $this->_description = $description;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.hireMe');
    }
}
