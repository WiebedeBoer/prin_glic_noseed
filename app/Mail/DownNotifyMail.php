<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OSnotifyMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($server_status,$server_name,$osmail)
    {
        //
        $this->server_status = $server_status;
        $this->server_name = $server_name;
        $this->osmail = $osmail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $server_status = $this->server_status;
        $server_name = $this->server_name;
        $osmail = $this->osmail;
        //return $this->view('emails.osnotify', compact('app_name','server_name'));
        //return $this->markdown('emails.osnotify')->with('app_name',$app_name)->with('server_name',$server_name);
        return $this->markdown('emails.downnotify')->with('server_status',$server_status)->with('server_name',$server_name)->from('1785641677-30c3a1@inbox.mailtrap.io')->subject('PRIN6 notificatie Status')->replyTo($osmail, 'prin6 status');
    
    }
}