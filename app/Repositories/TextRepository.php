<?php

namespace App\Repositories;


use App\Http\Requests\TextRequest;
use App\Models\Quiz\Quiz;
use App\Models\Text\Text;
use Carbon\Carbon;

class TextRepository
{

    public function create(TextRequest $request)
    {
        $question = Text::create($request->only(["name", "character_id", "quiz_id"]));
        if (!is_null($question)) {
            flash()->success("Shahed Created Successfully");
        } else {
            flash()->error("Error Creating Shahed!")->important();
        }
    }

    public function edit(TextRequest $request, Text $text)
    {
        if ($text->update($request->only(["name", "character_id", "quiz_id"])))
            flash()->success("Shahed Updated Successfully");
        else
            flash()->error("Error Updating Shahed!")->important();
    }

    public function getActiveQuizzes()
    {
        $now = Carbon::now()->toDateString();
        $competitions = auth("admin")->user()->competitions->where([["start", "<=", $now], ["end", ">=", $now]])->get();

        return Quiz::whereIn("competition_id", $competitions->pluck("id")->toArray())->pluck("name", "id");
    }

    public function delete(Text $text)
    {
        if($text->delete()) {
            flash()->warning("Shahed Deleted Successfully");
        }else flash()->error("Error Deleting Shahed");
    }

}