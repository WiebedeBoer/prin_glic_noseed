<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RemindNotifyMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($remindmail,$remindtext)
    {
        $this->remindmail = $remindmail;
        $this->remindtext = $remindtext;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //return $this->view('view.name');
        //return $this->markdown('emails.remindnotify')->with('remind_text',$remind_text);
        $remindmail = $this->remindmail;
        $remindtext = $this->remindtext;
        return $this->markdown('emails.remindnotify')->with('remindtext',$remindtext)->from('1785641677-30c3a1@inbox.mailtrap.io')->subject('PRIN6 notificatie reminder')->replyTo($remindmail, 'prin6 reminder');
    }
}
