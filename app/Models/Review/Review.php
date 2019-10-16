<?php

namespace App\Models\Review;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{

    protected $fillable = ["body", "rating"];

}
