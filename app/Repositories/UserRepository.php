<?php
namespace App\Repositories;

use App\Http\Requests\UserRequest;
use App\Models\AdminLog\AdminLog;
use App\Models\User\User;
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
        $fields = ['name', 'email', 'username'];
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

        return User::leftJoin('question_user', 'users.id', '=', 'question_user.user_id')
            ->selectRaw('users.*, SUM(question_user.points) AS points')
            ->groupBy('users.id')
            ->orderBy('points', 'desc')
            ->whereIn("group_id", $admin->groups()->pluck("id")->toArray())
            ->paginate($paginate);
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