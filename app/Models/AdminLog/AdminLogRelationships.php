<?php

namespace App\Models\AdminLog;

use App\Models\Admin\Admin;

trait AdminLogRelationships
{
    public function logable()
    {
        return $this->morphTo();
    }

    public function admin()
    {
        return $this->hasOne(Admin::class, 'id', 'admin_id');
    }
}