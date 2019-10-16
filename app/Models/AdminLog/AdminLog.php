<?php

namespace App\Models\AdminLog;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AdminLog\AdminLog
 *
 * @property-read \App\Models\Admin\Admin $admin
 * @property mixed $message
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $logable
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminLog\AdminLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminLog\AdminLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminLog\AdminLog query()
 * @mixin \Eloquent
 */
class AdminLog extends Model
{
    use AdminLogMethods, AdminLogRelationships, AdminLogAttributes;

    protected $table = "admins_log";
    protected $guarded = [];
    public $timestamps = false;
    protected $dates = ['done_at'];
    protected $with = ['admin', 'logable'];

    public function __construct(array $attributes = [])
    {
        $this->done_at = Carbon::now();
        $this->admin_id = auth()->guard('admin')->id();

        parent::__construct($attributes);
    }
}
