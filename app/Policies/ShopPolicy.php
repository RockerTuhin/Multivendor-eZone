<?php

namespace App\Policies;

use App\Shop;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ShopPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->hasRole('admin')) {
            return true;
        }
    }

    public function browse(User $user)
    {
        return $user->hasRole('seller');
    }
    
    public function read(User $user, Shop $shop)
    {
        return $user->id == $shop->user_id;
    }

    public function edit(User $user, Shop $shop)
    {
        return $user->id == $shop->user_id;
    }

    public function add(User $user)
    {

    }

    public function delete(User $user, Shop $shop)
    {
        return $user->id == $shop->user_id;
    }
}
