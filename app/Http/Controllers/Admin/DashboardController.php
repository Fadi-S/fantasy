<?php

namespace App\Http\Controllers\Admin;

use App\Charts\UserChart;
use App\Models\Admin\Admin;
use App\Models\Character\Character;
use App\Models\Competition\Competition;
use App\Models\Group\Group;
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

        $charts = [];
        foreach (auth("admin")->user()->groups as $group) {
            if($group->current_competition == null)
                continue;

            $charts[$group->id]["users"] = $this->usersChart($group);
        }

        return view('admin.index', compact("usersCount", "charactersCount", "competitionsCount", "adminsCount", 'charts'));
    }

    private function usersChart(Group $group)
    {
        $usersChart = new UserChart();
        $competition = $group->current_competition;

        $userCounts = [];
        foreach ($group->years as $year) {
            $userCounts[] = $year->users()->whereHas("competitions", function ($query) use($competition) {
                $query->where("id", $competition->id);
            })->count();
        }

        $usersChart->labels($group->years()->pluck("name"));

        $usersChart->options([
            "cutoutPercentage" => 70
        ]);

        $usersChart->dataset('Users', 'doughnut', $userCounts)
            ->backgroundcolor([
                "rgba(255, 99, 132, 0.6)",
                "rgba(22,160,133, 0.6)",
                "rgba(255, 205, 86, 0.6)",
            ]);

        return $usersChart;
    }
}
