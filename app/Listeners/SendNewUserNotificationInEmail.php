<?php

namespace App\Listeners;

use App\Events\MakeNewUser;
use App\Mail\UserCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendNewUserNotificationInEmail
{
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
     * @param  MakeNewUser  $event
     * @return void
     */
    public function handle(MakeNewUser $event)
    {
        Mail::to($event->user['email'])->send(new UserCreated($event->user));
    }
}
