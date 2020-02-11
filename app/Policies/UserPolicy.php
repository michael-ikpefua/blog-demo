<?php

namespace App\Policies;

use App\Classes\Permissions;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return $user->hasPermissionTo(Permissions::USER_CREATE);
    }

    public function show(User $user, User $model) {

        return 
            $user->hasPermissionTo(Permissions::USER_READ) ||
            $user->getKey() === $model->getKey();
    }

}
