<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    protected $email_title;
    protected $email_new_password;
    protected $email_fullname;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email_title,$email_new_password,$email_fullname)
    {
        $this->email_title= $email_title;
        $this->email_new_password= $email_new_password;
        $this->email_fullname = $email_fullname;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->email_title)
                    ->view('include.email-reset-password')
                    ->with([
                        'new_password' => $this->new_password,
                        'fullname' => $this->admin_fullname,
                    ]);
    }
}
