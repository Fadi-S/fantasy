<?php

namespace App\Models\User;

use App\Models\Competition\Competition;
use Carbon\Carbon;

trait UserMethods
{
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
}