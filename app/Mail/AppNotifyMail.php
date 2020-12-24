<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AppNotifyMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($app_name,$person_mail)
    {
        //
        $this->app_name = $app_name;
        $this->person_mail = $person_mail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $app_name = $this->app_name;
        $person_mail = $this->person_mail;
        //$subject = $this->subject;
        //return $this->markdown('emails.appnotify', compact('app_name'));

        //return $this->markdown('emails.appnotify')->with('app_name',$app_name);

        return $this->markdown('emails.appnotify')->with('app_name',$app_name)->from('1785641677-30c3a1@inbox.mailtrap.io')->subject('PRIN6 notificatie afhankelijkheden')->replyTo($person_mail, 'prin6 app');


    }
}
