<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailSendEmailSuccess extends Mailable
{
    use Queueable, SerializesModels;

    protected $email_title;
    protected $email_fullname;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email_title,$email_fullname)
    {
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
                    ->view('include.email-send-email-success')
                    ->with([
                        'fullname' => $this->email_fullname,
                        'message' => $this
                    ]);
    }
}
