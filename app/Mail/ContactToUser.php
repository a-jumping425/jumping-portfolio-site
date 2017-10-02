<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Input;

class ContactToUser extends Mailable
{
    use Queueable, SerializesModels;

    public $name = '';
    public $email = '';
    public $message = '';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        $name = Input::get('name');
        $email = Input::get('email');
        $message = Input::get('message');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.contact_user');
    }
}
