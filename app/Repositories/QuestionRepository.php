<?php

namespace App\Repositories;


use App\Http\Requests\QuestionRequest;
use App\Models\Question\Question;

class QuestionRepository
{

    public function getAll($paginate = 100)
    {
        return Question::with(["quiz", "character"])->orderBy("quiz_id")->paginate($paginate);
    }

    public function create(QuestionRequest $request)
    {
        $choices = $request->choices;
        $question = Question::create($request->only(["body", "character_id", "quiz_id", "points"]));
        foreach($choices as $key => $choice) {
            $question->choices()->create([
                "name" => $choice["name"],
                "right" => $choice["id"] == $request->right
            ]);
        }
        if (!is_null($question)) {
            flash()->success("Question Created Successfully");
        } else {
            flash()->error("Error Creating Question!")->important();
        }
    }

    public function edit(QuestionRequest $request, Question $question)
    {
        if ($question->update($request->only(["body", "character_id", "quiz_id", "points"]))) {
            $choices = $request->choices;
            foreach($choices as $key => $choice) {
                if($choice["id"] > 0) {
                    $question->choices()->where("id", $choice["id"])->update([
                        "name" => $choice["name"],
                        "right" => $choice["id"] == $request->right,
                    ]);
                }else{
                    $choices[$key] = $question->choices()->create([
                        "name" => $choice["name"],
                        "right" => $choice["id"] == $request->right,
                    ]);
                }
                $question->choices()->whereNotIn("id", array_column($choices, 'id'))->delete();
            }
            flash()->success("Question Updated Successfully");
        }else
            flash()->error("Error Updating Question!")->important();
    }

    public function delete(Question $question)
    {
        if($question->delete()) {
            flash()->warning("Question Deleted Successfully");
        }else flash()->error("Error Deleting Question");
    }

}