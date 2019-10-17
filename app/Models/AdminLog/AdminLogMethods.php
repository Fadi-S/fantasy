<?php

namespace App\Models\AdminLog;

use App\Models\Admin\Admin;
use Illuminate\Database\Eloquent\Model;

trait AdminLogMethods {

    public function action()
    {
        return $this->message['action'];
    }

    public function logged()
    {
        $Logged = $this->logable_type;
        return $Logged::withTrashed()->find($this->logable_id);
    }
    public function old()
    {
        return $this->message['old'];
    }

    public function creator()
    {
        return Admin::withTrashed()->find($this->admin_id);
    }

    public function humanReadableType()
    {
        return explode('\\', str_replace('App\\Models\\', '', $this->logable_type))[0];
    }

    public function new()
    {
        return $this->message['new'];
    }

    public static function createRecord($action, Model $logable, $keys=null, $values=null, $relations=[])
    {
        if($action == 'edit') {
            $old = [];
            $new = [];

            $fields = $logable->getFillable();
            if(sizeof($fields) == 0)
                $fields = \Schema::getColumnListing($logable->getTable());
            $fields = array_merge($fields, $relations);

            foreach($keys as $key) {
                if(in_array($key,  $fields)) {
                    if(in_array($key, $relations)) {
                        if($logable->$key->pluck("id")->toArray() != $values[$key]) {
                            $old[$key] = $logable->$key->pluck("id")->toArray();
                            $new[$key] = $values[$key];
                        }
                    }else{
                        if($logable->getAttributes()[$key] != $values[$key]) {
                            $old[$key] = $logable->getAttributes()[$key];
                            $new[$key] = $values[$key];
                        }
                    }
                }
            }
            if(empty($old))
                return false;

            $logable->adminLog()->create(
                [
                    'message' => [
                        'action' => $action,
                        'old' => $old,
                        'new' => $new,
                    ]
                ]);
        }else
            $logable->adminLog()->create(['message' => ['action' => $action]]);

        return true;
    }
}