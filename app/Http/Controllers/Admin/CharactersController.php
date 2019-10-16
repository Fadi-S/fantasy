<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CharacterRequest;
use App\Models\Category\Category;
use App\Models\Character\Character;
use App\Repositories\CharacterRepository;
use App\Http\Controllers\Controller;

class CharactersController extends Controller
{
    private $characterRepo;

    public function __construct(CharacterRepository $characterRepo)
    {
        $this->characterRepo = $characterRepo;
        $this->middleware("auth:admin");
    }

    public function index()
    {
        $characters = $this->characterRepo->getAll();

        return view('admin.characters.index', compact('characters'));
    }

    public function show(Character $character)
    {
        return view('admin.characters.show', compact('character'));
    }

    public function edit(Character $character)
    {
        $categories = Category::pluck("name", "id")->toArray();
        return view('admin.characters.edit', compact('character', 'categories'));
    }

    public function create()
    {
        $categories = Category::pluck("name", "id")->toArray();
        return view('admin.characters.create', compact('categories'));
    }

    public function store(CharacterRequest $request)
    {
        $this->characterRepo->create($request);
        return redirect('/admin/characters/create');
    }

    public function update(CharacterRequest $request, Character $character)
    {
        $this->characterRepo->edit($request, $character);
        return redirect("/admin/characters/$character->id/edit");
    }

    public function destroy(Character $character)
    {
        $this->characterRepo->delete($character);
        return redirect("/admin/characters");
    }
}
