<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

abstract class CrudController extends Controller
{
    /* Полное имя класса для операций CRUD */
    protected $modelClass;

    /**
     * Метод для создания новой сущности
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        try {
            $model = (new $this->modelClass())::create($request->all());
            if ($model->save()) {
                return new JsonResponse($model, 200);
            } else {
                return new JsonResponse(null, 400);
            }
        } catch (\Illuminate\Database\QueryException $e){
            return new JsonResponse($e, 400);
        }
    }

    /**
     * Метод для получения сущности по ID
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(string $id)
    {
        $model = (new $this->modelClass)::find($id);
        if (empty($model)) {
            return new JsonResponse(null, 404);
        }
        return new JsonResponse($model, 200);
    }

    /**
     * Метод для получения списка сущностей
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function list(Request $request)
    {
        $models = (new $this->modelClass)::all();
        $response = new JsonResponse($models, 200);
        return $response;
    }

    /**
     * Метод для обновления сущности по ID
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(string $id, Request $request)
    {
        $model = (new $this->modelClass)::find($id);
        if (empty($model)) {
            $response = new JsonResponse(null, 404);
            return $response;
        }
        try {
            $model->update($request->all());
        } catch (\Illuminate\Database\QueryException $e){
            return new JsonResponse($e, 400);
        }
        if ($model->save()) {
            return new JsonResponse($model, 200);
        } else {
            return new JsonResponse(null, 400);
        }
    }

    /**
     * Метод для удаления сущности по ID
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(string $id)
    {
        $model = (new $this->modelClass)::find($id);
        if (empty($model)) {
            return new JsonResponse(null, 404);
        } else {
            $model->delete();
            return new JsonResponse(null, 200);
        }
    }
}
