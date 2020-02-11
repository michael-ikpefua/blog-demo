<?php 

namespace App\Classes;

use Spatie\Permission\Models\Permission;


class Permissions {
    
    const USER_CREATE = "User Create";
    const USER_READ = "User Read";
    const USER_DELETE = "User Delete";
    const USER_UPDATE = "User Update";

    public static function drop($permissions) 
    {
        collect($permissions)->each(function ($permissionName) {
            
            $permission = Permission::findByName($permissionName);
            $permission->syncRoles();
            $permission->delete();
        });
    }
}