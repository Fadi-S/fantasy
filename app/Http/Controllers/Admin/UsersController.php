<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use App\Models\Competition\Competition;
use App\Models\Question\Question;
use App\Models\User\User;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    private $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
        $this->middleware("auth:admin");
    }

    public function index()
    {
        $users = $this->userRepo->getAll();
        return view('admin.users.index', compact('users'));
    }

    public function show($user)
    {
        $user = $this->userRepo->getUser($user);

        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(UserRequest $request)
    {
        $this->userRepo->createUser($request);
        return redirect('/admin/users/create');
    }

    public function update(UserRequest $request, User $user)
    {
        $this->userRepo->editUser($request, $user);
        return redirect("/admin/users/$user->username/edit");
    }

    public function destroy(Request $request, User $user)
    {
        $this->userRepo->deleteUser($request, $user);
        return redirect("/admin/users");
    }

    public function savePoints(User $user, Request $request)
    {
        $question = Question::with(["character", "quiz"])->find($request->question_id);

        $answer = $user->questions()->where("question_id", $request->question_id)->first();

        $points = ($answer->points >= $request->points) ? ($request->points >= 0) ? $request->points : 0 : $answer->points;

        if($question->character->users()->where([["user_id", $user->id], ["quiz_id", $question->quiz_id]])->first()->pivot->captain)
            $points = $points * 2;

        $answer->pivot->points = $points;

        $answer->pivot->save();

        return response(["points" => $answer->pivot->points . "/$answer->points", "total_points" => $user->points]);
    }

    public function calculatePoints()
    {
        $users = User::whereIn("group_id", auth("admin")->user()->groups()->pluck("id")->toArray())->get();

        foreach ($users as $user)
            $user->calculatePoints($user->group->current_competition);

        return redirect()->back();
    }

    public function calculatePointsForCompetition(Competition $competition)
    {
        foreach ($competition->users as $user)
            $user->calculatePoints($competition);

        return redirect()->back();
    }
    
}
