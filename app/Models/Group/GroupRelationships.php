<?php

namespace App\Models\Group;

use App\Models\Admin\Admin;
use App\Models\AdminLog\AdminLog;
use App\Models\Competition\Competition;
use App\Models\User\User;
use App\Models\Year\Year;

trait GroupRelationships
{

    public function competitions()
    {
        return $this->hasMany(Competition::class);
    }

    public function years()
    {
        return $this->hasMany(Year::class);
    }

    public function admins()
    {
        return $this->belongsToMany(Admin::class, "admin_group", "group_id");
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function adminLog()
    {
        return $this->morphMany(AdminLog::class, 'logable');
    }

}