<?php

namespace App\Http\Controllers\Admin;

use App\Models\Review\Review;
use App\Http\Controllers\Controller;

class ReviewsController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth:admin");
    }

    public function index()
    {
        $reviews = Review::latest()->paginate(100);
        return view('admin.users.reviews', compact('reviews'));
    }

}
