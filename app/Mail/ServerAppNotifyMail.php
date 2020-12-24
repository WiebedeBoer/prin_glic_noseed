<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ServerAppNotifyMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($app_name,$server_name,$serverappmail)
    {
        //
        $this->app_name = $app_name;
        $this->server_name = $server_name;
        $this->serverappmail = $serverappmail;
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
        $serverappmail = $this->serverappmail;
        //return $this->view('emails.serverappnotify', compact('app_name','server_name'));
        //return $this->markdown('emails.serverappnotify')->with('app_name',$app_name)->with('server_name',$server_name);
        return $this->markdown('emails.serverappnotify')->with('app_name',$app_name)->with('server_name',$server_name)->from('1785641677-30c3a1@inbox.mailtrap.io')->subject('PRIN6 notificatie Server en App')->replyTo($serverappmail, 'prin6 server en app');
    }
}
