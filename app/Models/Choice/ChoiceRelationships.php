<?php

namespace App\Models\Choice;


use App\Models\Question\Question;

trait ChoiceRelationships
{

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

}