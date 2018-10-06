<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $table = "grades";

    protected $fillable = ["user_id", "meme_id", "value"];
}
