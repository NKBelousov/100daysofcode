<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    protected static function getModelParams(Request $request)
    {
        $data = $request->all();
        $data["user_id"] = Auth::user()->id;
        return $data;
    }
}
