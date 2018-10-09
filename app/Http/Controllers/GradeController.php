<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Grade;

class GradeController extends CrudController
{
    protected $modelClass = "\App\Grade";

    protected static function getModelParams(Request $request)
    {
        $data = $request->all();
        $data["user_id"] = Auth::user()->id;
        return $data;
    }

    /**
     * Метод для создания новой сущности
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $data = $this->getModelParams($request);
        $user = Auth::user();
        $grades = Grade::where([
            'user_id' => $user->id,
            'meme_id' => $data['meme_id'],
        ]);
        if (count($grades) > 0) {
            return new JsonResponse([
                'error' => 'already_exists',
            ], 400);
        }
        try {
            $data = $this::getModelParams($request);
            $model = $this->modelClass::create($data);
            if ($model->save()) {
                return new JsonResponse($model, 200);
            } else {
                return new JsonResponse(null, 400);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            return new JsonResponse($e, 400);
        }
    }
}
