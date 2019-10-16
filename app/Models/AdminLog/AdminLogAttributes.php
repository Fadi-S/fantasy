<?php

namespace App\Models\AdminLog;

trait AdminLogAttributes
{
    public function setMessageAttribute($message) {
        $this->attributes['message'] = json_encode($message);
    }

    public function getMessageAttribute($message) {
        return json_decode($message, true);
    }


}