<?php

namespace CMS\User\Mail;

use CMS\User\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var User
     */
    public $code;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($code)
    {

        $this->code = $code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('User::mails.reset-password-verify-code')->
            subject('اول کارت | تغییر رمز عبور');
    }
}
