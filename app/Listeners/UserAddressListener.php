<?php

namespace App\Listeners;

use App\Events\UserCreatedOrUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserAddressListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserCreatedOrUpdated $event): void
    {
//        $user = $event->user;
//        $addressesData = $event->addressesData;
//
//        foreach ($addressesData as $addressData) {
//            $user->addresses()->create($addressData);
//        }
    }
}
