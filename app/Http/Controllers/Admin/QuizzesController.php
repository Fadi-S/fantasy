<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\QuizRequest;
use App\Models\Quiz\Quiz;
use App\Repositories\QuizRepository;
use App\Http\Controllers\Controller;

class QuizzesController extends Controller
{

    private $quizRepo;

    public function __construct(QuizRepository $quizRepo)
    {
        $this->quizRepo = $quizRepo;
        $this->middleware("auth:admin");
    }

    public function index()
    {
        $quizzes = $this->quizRepo->getAll();

        return view('admin.quizzes.index', compact('quizzes'));
    }

    public function show(Quiz $quiz)
    {
        return view('admin.quizzes.show', compact('quiz'));
    }

    public function edit(Quiz $quiz)
    {
        return view('admin.quizzes.edit', compact('quiz'));
    }

    public function create()
    {
        return view('admin.quizzes.create');
    }

    public function store(QuizRequest $request)
    {
        $this->quizRepo->create($request);
        return redirect('/admin/quizzes/create');
    }

    public function update(QuizRequest $request, Quiz $quiz)
    {
        $this->quizRepo->edit($request, $quiz);
        return redirect("/admin/quizzes/$quiz->id/edit");
    }

    public function destroy(Quiz $quiz)
    {
        $this->quizRepo->delete($quiz);
        return redirect("/admin/quizzes");
    }

}
