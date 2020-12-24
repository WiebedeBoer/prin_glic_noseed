<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ObsoleteNotifyMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($app_name,$server_name,$automail)
    {
        //
        $this->app_name = $app_name;
        $this->server_name = $server_name;
        $this->automail = $automail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $app_name = $this->app_name;
        $server_name = $this->server_name;
        //return $this->view('emails.osnotify', compact('app_name','server_name'));
        //return $this->markdown('emails.obsoletenotify')->with('app_name',$app_name)->with('server_name',$server_name);

        $automail = $this->automail;

        return $this->markdown('emails.obsoletenotify')->with('app_name',$app_name)->with('server_name',$server_name)->from('1785641677-30c3a1@inbox.mailtrap.io')->subject('PRIN6 notificatie OS oud')->replyTo($automail, 'prin6 obsolete');
    }
}
