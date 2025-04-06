<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 8/29/2020
 * Time: 1:29 AM
 */

namespace CMS\Newsletter\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewsletterMail extends Mailable
{
    use Queueable, SerializesModels;
    private $subjects;
    private $contents;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject,$contents)
    {
        $this->subjects=$subject;
        $this->contents=$contents;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->view('Newsletter::emails.newsletter')
            ->subject($this->subjects)
            ->with([
                "contents"=>$this->contents
            ]);
        ;
    }
}
