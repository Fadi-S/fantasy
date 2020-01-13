<?php
namespace App\Repositories;

use App\Http\Requests\UserRequest;
use App\Models\AdminLog\AdminLog;
use App\Models\Competition\Competition;
use App\Models\Question\Question;
use App\Models\User\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserRepository
{
    public function createUser(UserRequest $request)
    {
        $user = User::create($request->all());
        if (!is_null($user)) {
            AdminLog::createRecord("add", $user);
            flash()->success("User Created Successfully, Password: " . $request->password);
        } else {
            flash()->error("Error Creating User!")->important();
        }
    }

    public function editUser(UserRequest $request, User $user)
    {
        if (!AdminLog::createRecord("edit", $user, $request->keys(), $request->all())) {
            flash()->error("You didn't change anything!");

            return;
        }
        $fields = ['name', 'email', 'username', 'group_id'];
        if($request->password != '')
            $fields[] = "password";
        if ($user->update($request->only($fields)))
            flash()->success("User Updated Successfully");
        else
            flash()->error("Error Updating User!")->important();
    }

    public function getAll($paginate = 100)
    {
        $admin = auth("admin")->user();

        $competitionIds = [];
        foreach ($admin->groups as $group) {
            $competition = $group->current_competition;

            if(!is_null($competition)) $competitionIds[] = $competition->id;
        }

        return User::leftJoin('competition_user', function ($join) use ($competitionIds) {
            $join->on("users.id", "=", 'competition_user.user_id')
                ->whereIn("competition_user.competition_id", $competitionIds);
        })->selectRaw('users.*, competition_user.points AS points')
            ->groupBy('users.id')
            ->orderBy('points', 'desc')
            ->whereIn("users.group_id", $admin->groups()->pluck("id")->toArray())
            ->get();
    }

    public function getUser($user)
    {
        $user = User::where("username", $user)->first();

        $curCompetition = $user->group->current_competition;

        return User::where("username", $user->username)->with(["questions" => function($query) use($curCompetition) {
            $query->whereHas("quiz", function ($query) use($curCompetition) {
                $query->where("competition_id", ($curCompetition != null) ? $curCompetition->id : 0);
            });
        }])->first();
    }

    public function deleteUser(Request $request, User $user)
    {
        $success = false;
        if($request->action == "Delete")
            $success = $user->delete();
        else if($request->action == 'Delete From Database')
            $success = $user->forceDelete();

        if($success) {
            flash()->warning("User Deleted Successfully");
            AdminLog::createRecord("delete", $user);
        }else flash()->error("Error Deleting User");
    }

    public function changePicture(Request $request, User $user=null)
    {
        if($request->hasFile("image")) {
            if(is_null($user))
                $user = auth()->user();

            $file = $request->file("image");

            $image = str_random(60) . '.' . $file->extension();

            if($file->storeAs('public/photos/users', $image)) {
                if(!is_null($user->getOriginal('picture'))) {
                    if (\Storage::exists('public/photos/users/' . $user->getOriginal('picture')))
                        \Storage::delete('public/photos/users/' . $user->getOriginal('picture'));
                }

                $user->picture = $image;

                $user->save();

                $request->request->set("picture", $image);

                return true;
            }
        }
        return false;
    }
}