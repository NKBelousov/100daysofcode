<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends CrudController
{
    protected $modelClass = "\App\Favorite";

    protected static function getModelParams(Request $request)
    {
        $data = $request->all();
        $data["user_id"] = Auth::user()->id;
        return $data;
    }
}
