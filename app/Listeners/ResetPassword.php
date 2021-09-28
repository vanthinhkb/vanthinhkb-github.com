<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\SendMailResetPassword;
use Illuminate\Support\Facades\Mail;

class ResetPassword implements ShouldQueue
{
    use Queueable, SerializesModels;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {

        $message = $event->message;

        $content_email = $event->content_mail;

        $request = $event->request;
        
        Mail::send('frontend.mail.mail-resetpassword', $content_email, function ($msg) use($request,$message) {
            $msg->from('vuvannam16011997@gmail.com', 'Website - HICHEM');
            $msg->to($request['email_reset'], 'Website - HICHEM')->subject($message);
        });
    }
}
