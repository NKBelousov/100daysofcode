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

    protected $fillable = ["title", "description", "user_id"];

    /**
     * Метод для получения пользовательских оценок
     */
    public function grades()
    {
        return $this->hasMany('\App\Grade');
    }

    /**
     * Метод для получения пользовательских закладок
     */
    public function favorites()
    {
        return $this->hasMany('\App\Favorite');
    }

    /**
     * Метод для получения пользовательских закладок
     */
    public function tags()
    {
        return $this->belongsToMany('\App\Tag', 'memes_tags');
    }
}
