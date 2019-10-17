<?php

namespace App\Models\User;

use App\Notifications\UserResetPasswordNotification;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\Models\User\User
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AdminLog\AdminLog[] $adminLog
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Character\Character[] $characters
 * @property-read mixed $points
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Question\Question[] $questions
 * @property-write mixed $password
 * @property-write mixed $refresh_token
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User\User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User\User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User\User withoutTrashed()
 * @mixin \Eloquent
 * @property mixed $email
 * @property mixed $name
 * @property mixed $picture
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Quiz\Quiz[] $solvedQuizzes
 */
class User extends Authenticatable
{
    use Notifiable, SoftDeletes, UserAttributes, UserMethods, UserRelationships;

    protected $fillable = ['name', 'email', 'password', 'username', 'year_id', 'group_id', 'picture'];
    protected $dates = ['api_token_time'];
    protected $hidden = ['password', 'remember_token', "api_token", "refresh_token", "api_token_time"];

    public function getRouteKeyName()
    {
        return "username";
    }

    public function sendPasswordResetNotification($token) {
        $this->notify(new UserResetPasswordNotification($token, $this->email));
    }
}
