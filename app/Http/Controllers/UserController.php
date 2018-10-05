<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Meme;

class UserController extends CrudController
{
    protected $modelClass = "\App\User";
    /**
     * Представление для личного профиля
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        return view('profile');
    }

    /**
     * Представление для списка пользователей
     *
     * @return \Illuminate\Http\Response
     */
    public function users()
    {
        return view('users');
    }

    /**
     * Метод для получения текущего авторизованного пользователя
     *
     * @return \Illuminate\Http\Response
     */
    public function current(Request $request)
    {
        return Auth::user();
    }

    /**
     *
     * Представление для ленты мемов
     *
     * @return \Illuminate\Http\Response
     */
    public function feed()
    {
        return view('feed');
    }

    /**
     * Метод для получения ленты мемов
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMemeFeed()
    {
        $models = $this->modelClass::all();
        $response = new JsonResponse($models, 200);
        return $response;
    }
}
