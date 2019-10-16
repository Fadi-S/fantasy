<?php

namespace App\Models\Admin;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

/**
 * App\Models\Admin\Admin
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AdminLog\AdminLog[] $adminLog
 * @property-read mixed $picture
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-write mixed $password
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Admin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Admin newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Admin onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Admin query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Admin withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Admin withoutTrashed()
 * @mixin \Eloquent
 */
class Admin extends Authenticatable
{
    use Notifiable, SoftDeletes, AdminAttributes, AdminMethods, AdminRelationships;

    protected $fillable = ['email', 'username', 'name', 'picture', 'password', 'role_id'];
    protected $hidden = ['password', 'remember_token'];
    protected $table = "admins";

    public function getRouteKeyName()
    {
        return "username";
    }
}
