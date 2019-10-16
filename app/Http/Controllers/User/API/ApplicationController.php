<?php

namespace App\Http\Controllers\User\API;

use App\Models\Review\Review;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApplicationController extends Controller
{

    private $userRepo;

    public function __construct(UserRepository $repository)
    {
        $this->userRepo = $repository;
        $this->middleware("auth:api")->except("saveReview");
    }

    public function changePicture(Request $request)
    {
        $user = $request->user('api');
        if($this->userRepo->changePicture($request, $user))
            return response(["image" => $user->picture]);

        return response()->setStatusCode(401)->json(["error" => "Couldn't upload picture"]);
    }

    public function saveReview(Request $request)
    {
        $review = Review::create($request->all());
        if(!is_null($review))
            return response(["message" => "Review Submitted Successfully"], 201);

        return response(["message" => "Something Wrong happened"], 408);
    }

}
