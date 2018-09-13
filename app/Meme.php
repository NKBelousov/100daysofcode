<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meme extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "memes";

    protected $fillable = ["title", "description"];
}
