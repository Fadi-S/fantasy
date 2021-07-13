<?php

namespace App\Models\User;

use App\Notifications\UserResetPasswordNotification;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, UserAttributes, UserMethods, UserRelationships;

    protected $fillable = ['name', 'email', 'password', 'username', 'year_id', 'group_id', 'picture'];
    protected $dates = ['api_token_time'];
    protected $hidden = ['password', 'remember_token', "api_token", "refresh_token", "api_token_time"];

    protected $connection = 'mysql_service';

    public function getRouteKeyName()
    {
        return "username";
    }

    public function sendPasswordResetNotification($token) {
        $this->notify(new UserResetPasswordNotification($token, $this->email));
    }
}
