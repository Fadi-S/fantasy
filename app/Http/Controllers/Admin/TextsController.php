<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TextRequest;
use App\Models\Character\Character;
use App\Models\Quiz\Quiz;
use App\Models\Text\Text;
use App\Http\Controllers\Controller;
use App\Repositories\TextRepository;

class TextsController extends Controller
{
    private $textRepo;

    public function __construct(TextRepository $textRepo)
    {
        $this->textRepo = $textRepo;
        $this->middleware("auth:admin");
    }

    public function edit(Text $text)
    {
        $characters = Character::pluck("name", "id")->toArray();
        $quizzes = Quiz::pluck("name", "id")->toArray();
        return view('admin.texts.edit', compact('text', "characters", "quizzes"));
    }

    public function create()
    {
        $characters = Character::pluck("name", "id")->toArray();
        $quizzes = Quiz::pluck("name", "id")->toArray();
        return view('admin.texts.create', compact("characters", "quizzes"));
    }

    public function store(TextRequest $request)
    {
        $this->textRepo->create($request);
        return redirect('/admin/texts/create');
    }

    public function update(TextRequest $request, Text $text)
    {
        $this->textRepo->edit($request, $text);
        return redirect("/admin/texts/$text->id/edit");
    }

    public function destroy(Text $text)
    {
        $this->textRepo->delete($text);
        return redirect()->back();
    }
}
