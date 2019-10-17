<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\GroupRequest;
use App\Models\Admin\Admin;
use App\Models\Group\Group;
use App\Http\Controllers\Controller;
use App\Models\Year\Year;
use App\Repositories\GroupRepository;

class GroupsController extends Controller
{
    private $groupRepo;

    public function __construct(GroupRepository $groupRepo)
    {
        $this->groupRepo = $groupRepo;
        $this->middleware("auth:admin");
    }

    public function index()
    {
        $groups = $this->groupRepo->getAll();

        return view('admin.groups.index', compact('groups'));
    }

    public function show(Group $group)
    {
        return view('admin.groups.show', compact('group'));
    }

    public function edit(Group $group)
    {
        $admins = Admin::pluck("name", "id");
        $years = Year::pluck("name", "id");
        return view('admin.groups.edit', compact('group', "admins", "years"));
    }

    public function create()
    {
        $admins = Admin::pluck("name", "id");
        $years = Year::pluck("name", "id");
        return view('admin.groups.create', compact("admins", "years"));
    }

    public function store(GroupRequest $request)
    {
        $this->groupRepo->create($request);
        return redirect('/admin/groups/create');
    }

    public function update(GroupRequest $request, Group $group)
    {
        $this->groupRepo->edit($request, $group);
        return redirect("/admin/groups/$group->slug/edit");
    }

    public function destroy(Group $group)
    {
        $this->groupRepo->delete($group);
        return redirect("/admin/groups");
    }
}
