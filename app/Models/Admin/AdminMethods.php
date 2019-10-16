<?php

namespace App\Models\Admin;

trait AdminMethods
{
    public function hasPermission($permission)
    {
        $permissions = $this->role->permissions()->pluck("name")->toArray();
        if(in_array($permission, $permissions))
            return true;
        return false;
    }

    public function hasPermissionGroup($group)
    {
        $groups = $this->role->permissions()->pluck("group")->toArray();
        if(in_array($group, $groups))
            return true;
        return false;
    }
}