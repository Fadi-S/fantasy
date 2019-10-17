<?php

namespace App\Repositories;

use App\Http\Requests\QuizRequest;
use App\Models\AdminLog\AdminLog;
use App\Models\Competition\Competition;
use App\Models\Quiz\Quiz;
use Carbon\Carbon;

class QuizRepository
{

    public function create(QuizRequest $request)
    {
        $quiz = Quiz::create($request->all());
        if (!is_null($quiz)) {
            AdminLog::createRecord("add", $quiz);
            flash()->success("Quiz Created Successfully");
        } else {
            flash()->error("Error Creating Quiz!")->important();
        }
    }

    public function edit(QuizRequest $request, Quiz $quiz)
    {
        if (!AdminLog::createRecord("edit", $quiz, $request->keys(), $request->all())) {
            flash()->error("You didn't change anything!");

            return;
        }

        if ($quiz->update($request->all()))
            flash()->success("Quiz Updated Successfully");
        else
            flash()->error("Error Updating Quiz!")->important();
    }

    public function getAll($paginate = 100)
    {
        return Quiz::with("questions")->orderBy("start_date", "desc")->paginate($paginate);
    }

    public function getCurrentCompetitions()
    {
        $now = Carbon::now()->toDateString();

        return auth("admin")->user()->competitions->where([["start", "<=", $now], ["end", ">=", $now]]);
    }

    public function delete(Quiz $quiz)
    {
        if($quiz->delete()) {
            flash()->warning("Quiz Deleted Successfully");
            AdminLog::createRecord("delete", $quiz);
        }else flash()->error("Error Deleting Quiz");
    }

}