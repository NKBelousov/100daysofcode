<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Show current user profile
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        return view('profile');
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
        $method = $request->method();
        if ($method !== "POST"){
            $response->setData("Некорректный метод для создания пользователя: $method");
        } else {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            $response->setData($user);
        }
        return $response;
    }
}
