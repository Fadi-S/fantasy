<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Admin;
use App\Models\Character\Character;
use App\Models\Question\Question;
use App\Models\Quiz\Quiz;
use App\Models\User\User;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $usersCount = User::count();
        $charactersCount = Character::count();
        $quizzesCount = Quiz::count();
        $adminsCount = Admin::count();
        return view('admin.index', compact("usersCount", "charactersCount", "quizzesCount", "adminsCount"));
    }
}
