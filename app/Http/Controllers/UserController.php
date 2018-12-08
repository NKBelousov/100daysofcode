<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Meme;
use App\User;

class UserController extends CrudController
{
    protected $modelClass = "\App\User";

    /**
     * Метод получения данных для создания сущности
     * @param \Illuminate\Http\Request
     * @return array
     */
    protected static function getModelParams(Request $request)
    {
        $user = User::find($request->id);
        $data = $request->all();
        if (!empty($user) && !empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        return $data;
    }

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
    public function current()
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
    public function getMemeFeed(Request $request)
    {
        $user = $this->current();
        $id = $user["id"];
        $models = Meme
            ::with("grades")
            ->with("tags")
            ->with("favorites")
            ->with("author");
        if ($request->has("search")) {
            $term = '%'. strtolower($request->search) . '%';
            $models = $models
                ->where("title", "like", $term)
                ->orWhere("description", "like", $term)
                ->orWhereHas("tags", function ($query) use ($term) {
                    $query->where("name", "like", $term);
                });
        }
        if ($request->has("sortBy") && $request->has("orderBy")) {
            $models = $models->orderBy($request->sortBy, $request->orderBy);
        }
        $paginated = $models->paginate($request->perPage);
        $response = new JsonResponse($paginated, 200);
        return $response;
    }
}
