<?php

namespace App\Listeners;


use Illuminate\Auth\Events\Logout; 
use App\Models\SellerActivity;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogSuccessfulLogout
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
     * @param  \App\Events\Logout  $event
     * @return void
     */
    public function handle(Logout $event)
    {
        SellerActivity::create([
            'user_id' => $event->user->id,
            'activity_type' => 'logout',
            'created_at' => now(),
        ]);//
    }
}
