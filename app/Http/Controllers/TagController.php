<?php

namespace App\Http\Controllers;

class TagController extends CrudController
{
    protected $modelClass = "\App\Tag";

    /**
     * Представление для списка тегов
     *
     * @return \Illuminate\Http\Response
     */
    public function tags()
    {
        return view('tags');
    }
}
