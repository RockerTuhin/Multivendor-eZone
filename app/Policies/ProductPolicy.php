<?php

namespace App\Policies;

use App\Product;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
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
    
    public function read(User $user, Product $product)
    {
        if(empty($product->shop)) {
            return false;
        }
        return $user->id == $product->shop->user_id;
    }

    public function edit(User $user, Product $product)
    {
        if(empty($product->shop)) {
            return false;
        }
        return $user->id == $product->shop->user_id;
    }

    public function add(User $user)
    {
        return $user->hasRole('seller');
    }

    public function delete(User $user, Product $product)
    {
        if(empty($product->shop)) {
            return false;
        }
        return $user->id == $product->shop->user_id;
    }
}
