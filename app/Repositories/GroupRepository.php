<?php

namespace App\Repositories;


use App\Http\Requests\GroupRequest;
use App\Models\AdminLog\AdminLog;
use App\Models\Group\Group;
use App\Models\Year\Year;

class GroupRepository
{

    public function create(GroupRequest $request)
    {
        $group = Group::create($request->all());
        if (!is_null($group)) {

            $group->admins()->sync($request->admins);

            $group->years()->update(["group_id" => null]);
            Year::whereIn("id", $request->years)->update(["group_id" => $group->id]);

            AdminLog::createRecord("add", $group);
            flash()->success("Group Created Successfully");
        } else {
            flash()->error("Error Creating Group!")->important();
        }
    }

    public function edit(GroupRequest $request, Group $group)
    {
        AdminLog::createRecord("edit", $group, $request->keys(), $request->all(), ["years", "admins"]);

        if ($group->update($request->all())) {

            $group->admins()->sync($request->admins);

            $group->years()->update(["group_id" => null]);

            Year::whereIn("id", $request->years)->update(["group_id" => $group->id]);

            flash()->success("Group Updated Successfully");
        }else
            flash()->error("Error Updating Group!")->important();
    }

    public function getAll($paginate = 100)
    {
        return Group::paginate($paginate);
    }

    public function delete(Group $group)
    {
        if($group->delete()) {
            flash()->warning("Group Deleted Successfully");
            AdminLog::createRecord("delete", $group);
        }else flash()->error("Error Deleting Group");
    }


}