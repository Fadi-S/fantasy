<?php

namespace App\Models\Admin;

use App\Models\AdminLog\AdminLog;
use App\Models\Group\Group;

trait AdminRelationships
{
    public function adminLog()
    {
        return $this->morphMany(AdminLog::class, 'logable');
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, "admin_group", "admin_id", "group_id");
    }
}