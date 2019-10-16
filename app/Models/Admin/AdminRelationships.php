<?php

namespace App\Models\Admin;

use App\Models\AdminLog\AdminLog;

trait AdminRelationships
{
    public function adminLog()
    {
        return $this->morphMany(AdminLog::class, 'logable');
    }

}