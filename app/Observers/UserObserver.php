<?php

namespace App\Observers;
use App\Models\User;
use Illuminate\Support\Str;

class UserObserver
{
    /**
     * Handle the plan "creating" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function creating(User $user)
    {
        $user->uuid =  Str::uuid();
        $user->password = bcrypt('12345');
    }
}
