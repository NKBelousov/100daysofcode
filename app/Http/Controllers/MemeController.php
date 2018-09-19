<?php

namespace App\Http\Controllers;

class MemeController extends CrudController
{
    protected $modelClass = "\App\Meme";

    /**
     * Представление для списка мемов
     *
     * @return \Illuminate\Http\Response
     */
    public function memes()
    {
        return view('memes');
    }
}
