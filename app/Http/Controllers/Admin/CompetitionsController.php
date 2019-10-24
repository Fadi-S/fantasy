<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CompetitionRequest;
use App\Models\Competition\Competition;
use App\Http\Controllers\Controller;
use App\Models\CompetitionType\CompetitionType;
use App\Models\Group\Group;
use App\Repositories\CompetitionRepository;

class CompetitionsController extends Controller
{
    private $competitionRepo;

    public function __construct(CompetitionRepository $competitionRepo)
    {
        $this->competitionRepo = $competitionRepo;
        $this->middleware("auth:admin");
    }

    public function index()
    {
        $competitions = $this->competitionRepo->getAll();

        return view('admin.competitions.index', compact('competitions'));
    }

    public function show(Competition $competition)
    {
        return view('admin.competitions.show', compact('competition'));
    }

    public function edit(Competition $competition)
    {
        $groups = Group::pluck("name", "id");

        $types = CompetitionType::pluck("name", "id");

        return view('admin.competitions.edit', compact('competition', 'groups', 'types'));
    }

    public function create()
    {
        $groups = Group::pluck("name", "id");
        $types = CompetitionType::pluck("name", "id");

        return view('admin.competitions.create', compact('groups', 'types'));
    }

    public function store(CompetitionRequest $request)
    {
        $this->competitionRepo->create($request);
        return redirect('/admin/competitions/create');
    }

    public function update(CompetitionRequest $request, Competition $competition)
    {
        $this->competitionRepo->edit($request, $competition);
        return redirect("/admin/competitions/$competition->slug/edit");
    }

    public function destroy(Competition $competition)
    {
        $this->competitionRepo->delete($competition);
        return redirect("/admin/competitions");
    }
}
