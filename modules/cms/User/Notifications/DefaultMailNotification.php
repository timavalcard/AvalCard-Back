<?php

namespace CMS\User\Notifications;

use CMS\User\Mail\DefaultMail;
use CMS\User\Mail\VerifyCodeMail;
use CMS\User\Services\VerifyCodeService;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class DefaultMailNotification extends Notification
{
    use Queueable;

    private $content;
    public function __construct($content)
    {
        $this->content=$content;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {


        return (new DefaultMail($this->content))->to($notifiable->email);
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
