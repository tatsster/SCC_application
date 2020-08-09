<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailSignUp extends Mailable
{
    use Queueable, SerializesModels;

    protected $user_id;
    protected $user_fullname;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user_id,$user_fullname)
    {
        $this->user_id = $user_id;
        $this->user_fullname = $user_fullname;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Thông Báo Xác Nhận Tài Khoản !!!")
                    ->view('admin.email-signup')
                    ->with([
                        'user_id' => $this->user_id,
                        'fullname' => $this->user_fullname,
                    ]);
    }
}
