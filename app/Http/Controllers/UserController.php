<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
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
     * Метод для создания нового пользователя
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $response = new JsonResponse();
        $response->withHeaders([
            'Content-Type' => 'application/json'
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        $response->setData($user);
        return $response;
    }

    /**
     * Метод для получения пользователя по ID
     *
     * @return \Illuminate\Http\Response
     */
    public function get(string $id)
    {
        $user = User::find($id);
        if (empty($user)){
            return new JsonResponse(null, 404);
        }
        return new JsonResponse($user, 200);
    }

    /**
     * Метод для получения списка пользователей
     *
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        $users = User::all();
        $response = new JsonResponse($users, 200);
        return $response;
    }

    /**
     * Метод для обновления пользователя по id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(string $id, Request $request)
    {
        $user = User::find($id);
        if (empty($user)){
            $response = new JsonResponse(null, 404);
            return $response;
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        $response = new JsonResponse($user, 200);
        return $response;
    }

    /**
     * Метод для удаления пользователей по id
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(string $id)
    {
        $user = User::find($id);
        if (empty($user)){
            $response = new JsonResponse(null, 404);
            return $response;
        } else {
            $user->delete();
            $response = new JsonResponse(null, 200);
            return $response;
        }
    }
}
