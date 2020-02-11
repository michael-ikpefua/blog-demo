<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserPermissionRequest;
use App\User;

class UserPermissionController extends Controller
{
    public function __invoke(UserPermissionRequest $request, User $user)
    {
        $user->syncPermissions($request->get('permissions'));

        return redirect(route('user.show', $user->getKey()))->with('success', "Permission Granted to {$user->name} user ");
    }
}
