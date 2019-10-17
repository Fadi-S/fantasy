<?php

namespace App\Models\Year;

use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    use YearRelationships;

    protected $guarded = [];
}
