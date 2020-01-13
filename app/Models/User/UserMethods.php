<?php

namespace App\Models\User;

use App\Models\Competition\Competition;
use App\Models\Quiz\Quiz;
use Carbon\Carbon;

trait UserMethods
{
    private $totalQuestions;

    public function generateToken()
    {
        $this->api_token = str_random(60);
        $this->api_token_time = Carbon::now();
        $this->save();

        return $this->api_token;
    }

    public function generateRefreshToken()
    {
        $token = str_random(60);
        $this->refresh_token = $token;
        $this->save();

        return $token;
    }

    public function calculatePoints(Competition $competition)
    {
        if($competition->type_id == 2) {

            $points = 0;

            foreach ($competition->quizzes as $quiz) {

                $characters = $quiz->characters()->with("questions")->where("user_id", $this->id)->get();

                foreach ($characters as $character) {

                    $character_points = [];

                    $users = $character->users()->where("quiz_id", $quiz->id)->get();

                    foreach ($users as $user)  {

                        $character_points[] = $character->questions()
                            ->where('user_id', $user->id)
                            ->where("quiz_id", $quiz->id)
                            ->join('question_user', 'question_user.question_id', '=', 'questions.id')
                            ->sum('question_user.points');

                    }

                    if(count($character_points) > 0)
                        $points += array_sum($character_points) / count($character_points);

                }


            }

            $points = round($points);

        }else {
            $points = $this->questions()->whereHas('quiz', function ($query) use ($competition) {
                $query->where("competition_id", $competition->id);
            })->sum('question_user.points');
        }

        $this->competitions()->detach($competition->id);

        $this->competitions()->attach($competition->id, ["points" => $points]);

        return $points;
    }

    public function quizPoints(Quiz $quiz)
    {
        return $this->questions()->where("quiz_id", $quiz->id)->sum('question_user.points');
    }

    public function totalQuestionsInCompetition(Competition $competition=null)
    {
        if($this->totalQuestions != null) return $this->totalQuestions;

        if($competition == null) return 0;

        $quizzes = $competition->quizzes()->get();

        $questionsNumber = 0;

        foreach ($quizzes as $quiz) {
            $characters = $this->characters()->where([["quiz_id", $quiz->id], ["user_id", $this->id]])->pluck("id");

            $questionsNumber += $quiz->questions()->whereIn("character_id", $characters)->count();
        }

        $this->totalQuestions = $questionsNumber;

        return $questionsNumber;
    }

    public function totalPointsInCompetition(Competition $competition=null)
    {
        if($competition == null) return 0;

        return $this->questions()->where("question_user.points", ">", 0)->whereHas("quiz", function ($query) use ($competition) {
            $query->where("competition_id", $competition->id);
        })->get();
    }

    public function totalCorrectQuestionsInCompetition(Competition $competition=null)
    {
        if($competition == null) return 0;

        return $this->questions()->where("question_user.points", ">", 0)->whereHas("quiz", function ($query) use ($competition) {
            $query->where("competition_id", $competition->id);
        })->count();
    }

    public function totalWrongQuestionsInCompetition(Competition $competition=null)
    {
        if($competition == null) return 0;

        return $this->questions()->where("question_user.points", "=", 0)->whereHas("quiz", function ($query) use ($competition) {
            $query->where("competition_id", $competition->id);
        })->count();
    }

    public function unsolvedQuestionsInCompetition(Competition $competition=null) {
        $totalQuestions = $this->totalQuestionsInCompetition($competition);

        if($totalQuestions == 0) return 0;

        $solvedQuestions = $this->questions()->whereHas("quiz", function ($query) use ($competition) {
            $query->where("competition_id", $competition->id);
        })->count();

        return $totalQuestions - $solvedQuestions;
    }

    public function correctToTotalQuestionsPercentage(Competition $competition=null) {
        $totalQuestions = $this->totalQuestionsInCompetition($competition);

        if($totalQuestions == 0) return 0;

        return round($this->totalCorrectQuestionsInCompetition($competition) / $totalQuestions, 3) * 100;
    }

    public function wrongToTotalQuestionsPercentage(Competition $competition=null) {
        $totalQuestions = $this->totalQuestionsInCompetition($competition);

        if($totalQuestions == 0) return 0;

        return round($this->totalWrongQuestionsInCompetition($competition) / $totalQuestions, 3) * 100;
    }
}