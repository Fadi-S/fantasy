<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AdminRequest;
use App\Models\Admin\Admin;
use App\Http\Controllers\Controller;
use App\Models\AdminLog\AdminLog;
use App\Repositories\AdminRepository;
use Illuminate\Http\Request;

class AdminsController extends Controller
{
    private $adminRepo;

    public function __construct(AdminRepository $adminRepo)
    {
        $this->adminRepo = $adminRepo;
        $this->middleware("auth:admin");
    }

    public function index()
    {
        $admins = $this->adminRepo->getAll();

        return view('admin.admins.index', compact('admins'));
    }

    public function activityLog()
    {
        $activities = $this->adminRepo->getActivities();
        $admin = auth()->guard("admin")->user();
        return view("admin.admins.activity", compact("activities", "admin"));
    }

    public function restoreActivity(AdminLog $activity)
    {
        if($this->adminRepo->restoreActivity($activity))
            flash()->success("This " . $activity->humanReadableType() . " has been successfully restored");
        else
            flash()->error("Couldn't restore " . $activity->humanReadableType())->important();

        return redirect()->back();
    }

    public function show(Admin $admin)
    {
        return view('admin.admins.show', compact('admin'));
    }

    public function edit(Admin $admin)
    {
        return view('admin.admins.edit', compact('admin'));
    }

    public function create()
    {
        return view('admin.admins.create');
    }

    public function showChangePasswordForm()
    {
        return view('admin.admins.changePassword');
    }

    public function changePassword(Request $request)
    {
        $this->adminRepo->changePassword($request);
        return redirect("/admin/change-password");
    }

    public function store(AdminRequest $request)
    {
        $this->adminRepo->createAdmin($request);
        return redirect('/admin/admins/create');
    }

    public function update(AdminRequest $request, Admin $admin)
    {
        $admin = $this->adminRepo->editAdmin($request, $admin);
        return redirect("/admin/admins/$admin->username/edit");
    }

    public function destroy(Admin $admin)
    {
        $this->adminRepo->deleteAdmin($admin);
        return redirect("/admin/admins");
    }
}
