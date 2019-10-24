<?php

namespace App\Http\Controllers\User\API;

use App\Models\Category\Category;
use App\Models\Character\Character;
use App\Models\Choice\Choice;
use App\Models\Question\Question;
use App\Models\Quiz\Quiz;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuizzesController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth:api");
    }

    public function saveCharactersToUser(Quiz $quiz, Request $request)
    {
        $user = $request->user("api");

        $characterIds = json_decode($request->data);
        $charactersModel = [];

        foreach($characterIds as $characterId)
            $charactersModel[$characterId] = ["quiz_id" => $quiz->id, "captain" => 0];

        $user->characters()->wherePivot("quiz_id", $quiz->id)->detach();

        $user->characters()->attach($charactersModel);

        return response(["message" => "Characters Saved Successfully"]);
    }

    public function saveCaptainToUser(Quiz $quiz, Request $request)
    {
        $user = $request->user("api");
        $character_id = $request->character_id;

        $character = $quiz->characters()->where([["character_id", $character_id], ["user_id", $user->id]])->first();

        $character->pivot->captain = 1;

        $character->pivot->save();

        return response(["message" => "Captain Saved"]);
    }

    public function saveQuestions(Request $request, Quiz $quiz)
    {
        $user = $request->user("api");
        $quizUser = $quiz->solvers()->where("user_id", $user->id)->first();

        $quizUser->pivot->ended_at = Carbon::now();
        $quizUser->pivot->save();

        $answers = json_decode($request->answers, true);

        foreach($answers as $question_id => $answer) {
            $question = Question::find($question_id);
            if($question != null ) {
                $choice = $question->choices()->where("id", $answer["answer"])->first();
                if ($choice != null) {
                    $points = (($choice->right) ? $question->points : 0);
                    if($question->character->users()->where([["user_id", $user->id], ["quiz_id", $quiz->id]])->first()->pivot->captain)
                        $points = $points * 2;
                    $answers[$question_id] = ["answer" => $answer["answer"], "points" => $points];
                }
            }
        }

        $user->questions()->attach($answers);

        return response(["message" => "Answers saved successfully", "points" => $user->points]);
    }

    public function getTexts(Quiz $quiz)
    {
        $quizClosure = function($query) use ($quiz) {
            $query->where("quiz_id", $quiz->id);
        };

        $hasQuestions = function($query) use($quizClosure) {
            return $query->whereHas("questions", $quizClosure);
        };

        $characters = Character::with(["texts" => $quizClosure, "questions" => $quizClosure])->whereHas("questions", $quizClosure)->whereHas("texts", $quizClosure)->get();
        $categories = Category::with(["characters.texts" => $quizClosure, "characters" => $hasQuestions])->whereHas("characters", $hasQuestions)->whereHas("characters.texts", $quizClosure)->get();


        return response([
            "characters" => $characters,
            "categories" => $categories,
        ]);
    }

    public function getQuizQuestions(Request $request, Quiz $quiz)
    {
        $user = $request->user("api");

        if(Carbon::now()->lessThan($quiz->start_date))
            return response(["message" => "Quiz didn't start yet!"], 408);

        if($user->solvedQuizzes()->where("quiz_id", $quiz->id)->exists())
            return response(["message" => "Quiz already solved!"], 408);

        $userClosure = function($query) use($user) {
            return $query->where("user_id", $user->id);
        };

        $quizClosure = function($query) use ($quiz) {
            return $query->where("quiz_id", $quiz->id);
        };

        $characters = $quiz->characters()->whereHas("questions", $userClosure)->with(["questions" => $quizClosure,])->get();

        $questions = [];
        $questionIds = [];

        foreach($characters as $character) {
            $questionId = $character->questions->pluck("id")->toArray();
            if(count(array_intersect($questionIds, $questionId)) !== 0)
                continue;
            $questions = array_merge($questions, $character->questions->toArray());
            $questionIds = array_merge($questionIds, $questionId);
        }

        $user->solvedQuizzes()->attach($quiz->id, ["started_at" => Carbon::now()]);

        if(!$user->competitions()->where("competition_id", $quiz->competition_id)->exists())
            $user->competitions()->attach($quiz->competition_id, ["points" => $user->points]);

        return response([
            "quiz_time" => $quiz->max_minutes,
            "questions" => $questions,
        ]);
    }

    public function getSolvedQuizQuestions(Request $request, Quiz $quiz)
    {
        $user = $request->user("api");

        $userClosure = function($query) use($user) {
            return $query->where("user_id", $user->id);
        };

        $quizClosure = function($query) use ($quiz) {
            return $query->where("quiz_id", $quiz->id);
        };

        $characters = $quiz->characters()->whereHas("questions", $userClosure)
            ->whereHas("questions.users", $userClosure)->with([
            "questions.users" => $userClosure,
            "questions" => $quizClosure,
        ])->get();

        $questions = [];
        $questionIds = [];

        foreach($characters as $character) {
            $questionId = $character->questions->pluck("id")->toArray();
            if(count(array_intersect($questionIds, $questionId)) !== 0)
                continue;
            $questions = array_merge($questions, $character->questions->toArray());
            $questionIds = array_merge($questionIds, $questionId);
        }

        return response(["questions" => $questions,]);
    }

    public function quizSolved(Quiz $quiz, Request $request)
    {
        return response(["solved" => $quiz->solvers()->where("user_id", $request->user("api")->id)->exists()]);
    }

    public function index(Request $request)
    {
        $user = $request->user("api");
        $userClosure = function($query) use ($user) {
            return $query->where("user_id", $user->id);
        };
        $now = Carbon::now();

        $curCompetition = $user->group->current_competition;
        $curCompetitionId = $curCompetition->id;
        if($curCompetition == null) $curCompetitionId = 0;

        return response(
            [
                "quizzes" => Quiz::where("competition_id", $curCompetitionId)
                    ->whereDoesntHave("solvers", $userClosure)
                    ->where("start_date", "<=", $now)
                    ->where("end_date", ">=", $now)
                    ->latest("start_date")->get()->toArray(),

                "solved_quizzes" => Quiz::where("competition_id", $curCompetitionId)
                    ->whereHas("solvers", $userClosure)
                    ->latest("start_date")
                    ->get()->toArray(),

                "ended_quizzes" => Quiz::where("competition_id", $curCompetitionId)
                    ->whereDoesntHave("solvers", $userClosure)
                    ->where("start_date", "<=", $now)
                    ->where("end_date", "<", $now)
                    ->latest("start_date")->get()->toArray(),
            ]
        );
    }

    public function getAllCharacters(Request $request)
    {
        $quiz = Quiz::find($request->quiz_id);
        $hasQuestions = function($query) use($quiz) {
            return $query->whereHas("questions", function($query) use($quiz) {
                return $query->where("quiz_id", $quiz->id);
            });
        };
        return response(
            ["categories" => Category::whereHas("characters", $hasQuestions)->with(["characters" => $hasQuestions])->get()->toArray()]
        );
    }
}
