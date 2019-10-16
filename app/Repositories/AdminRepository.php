<?php

namespace App\Repositories;

use App\Http\Requests\AdminRequest;
use App\Models\Admin\Admin;
use App\Models\AdminLog\AdminLog;
use Symfony\Component\HttpFoundation\Request;

class AdminRepository
{
    public function createAdmin(AdminRequest $request)
    {
        $admin = Admin::create($request->all());
        if (!is_null($admin)) {
            AdminLog::createRecord("add", $admin);
            flash()->success("Admin Created Successfully");
        } else {
            flash()->error("Error Creating Admin!")->important();
        }
    }

    public function editAdmin(AdminRequest $request, Admin $admin)
    {
        if (!AdminLog::createRecord("edit", $admin, $request->keys(), $request->all())) {
            flash()->error("You didn't change anything!");

            return $admin;
        }
        if ($admin->update($request->only(['name', 'email', 'username'])))
            flash()->success("Admin Updated Successfully");
        else
            flash()->error("Error Updating Admin!")->important();

        return $admin;
    }

    public function getActivities($paginate = 100)
    {
        return AdminLog::orderBy("done_at", 'desc')->paginate($paginate);
    }

    public function restoreActivity(AdminLog $activity)
    {
        AdminLog::createRecord("restore", $activity->logged());
        return $activity->logged()->restore();
    }

    public function getAll($paginate = 100)
    {
        return Admin::paginate($paginate);
    }

    public function deleteAdmin(Admin $admin)
    {
        if($admin->delete()) {
            flash()->warning("Admin Deleted Successfully");
            AdminLog::createRecord("delete", $admin);
        }else flash()->error("Error Deleting Admin");
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => "required",
            'new_password' => 'required|confirmed|min:6'
        ]);

        $admin = auth()->guard("admin")->user();

        if(\Hash::check($request->old_password, $admin->password)) {
            $admin->password = $request->new_password;
            $admin->save();
            flash()->success("Password Changed Successfully");
        }else
            flash()->error("Wrong Password");
    }
}