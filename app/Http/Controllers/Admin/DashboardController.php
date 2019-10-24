<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Admin;
use App\Models\Character\Character;
use App\Models\Competition\Competition;
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
        $usersCount = User::whereIn("group_id", auth("admin")->user()->groups()->pluck("id"))->count();
        $charactersCount = Character::count();
        $competitionsCount = Competition::whereIn("group_id", auth("admin")->user()->groups()->pluck("id"))->count();
        $adminsCount = Admin::count();
        return view('admin.index', compact("usersCount", "charactersCount", "competitionsCount", "adminsCount"));
    }
}
