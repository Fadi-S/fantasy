<?php

namespace App\Models\Character;


use App\Models\AdminLog\AdminLog;
use App\Models\Category\Category;
use App\Models\Question\Question;
use App\Models\Quiz\Quiz;
use App\Models\Text\Text;
use App\Models\User\User;

trait CharacterRelationships
{

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('captain');
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function quizzes()
    {
        return $this->belongsToMany(Quiz::class);
    }

    public function texts()
    {
        return $this->hasMany(Text::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, "category_id");
    }

    public function adminLog()
    {
        return $this->morphMany(AdminLog::class, 'logable');
    }

}