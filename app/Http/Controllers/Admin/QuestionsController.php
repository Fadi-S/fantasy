<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\QuestionRequest;
use App\Models\Character\Character;
use App\Models\Question\Question;
use App\Models\Quiz\Quiz;
use App\Repositories\QuestionRepository;
use App\Http\Controllers\Controller;

class QuestionsController extends Controller
{
    private $questionRepo;

    public function __construct(QuestionRepository $questionRepo)
    {
        $this->questionRepo = $questionRepo;
        $this->middleware("auth:admin");
    }

    public function index()
    {
        $questions = $this->questionRepo->getAll();
        return view('admin.questions.index', compact('questions'));
    }

    public function show(Question $question)
    {
        return view('admin.questions.show', compact('question'));
    }

    public function edit(Question $question)
    {
        $competitionIds = [];
        foreach (auth("admin")->user()->groups as $group)
            $competitionIds[] = (!is_null($group->current_competition)) ? $group->current_competition->id : 0;

        $characters = Character::pluck("name", "id")->toArray();
        $quizzes = Quiz::whereIn('competition_id', $competitionIds)->pluck("name", "id")->toArray();
        return view('admin.questions.edit', compact('question', 'characters', 'quizzes'));
    }

    public function create()
    {
        $competitionIds = [];
        foreach (auth("admin")->user()->groups as $group)
            $competitionIds[] = (!is_null($group->current_competition)) ? $group->current_competition->id : 0;

        $characters = Character::pluck("name", "id")->toArray();
        $quizzes = Quiz::whereIn('competition_id', $competitionIds)->pluck("name", "id")->toArray();
        return view('admin.questions.create', compact('characters', 'quizzes'));
    }

    public function store(QuestionRequest $request)
    {
        $this->questionRepo->create($request);
        return redirect('/admin/questions/create');
    }

    public function update(QuestionRequest $request, Question $question)
    {
        $this->questionRepo->edit($request, $question);
        return redirect("/admin/questions/$question->id/edit");
    }

    public function destroy(Question $question)
    {
        $this->questionRepo->delete($question);
        return redirect()->back();
    }
}
