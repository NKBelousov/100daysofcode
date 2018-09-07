<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Метод для создания нового тега
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $tag = new Tag();
        $tag->name = $request->name;
        if ($tag->save()) {
            return new JsonResponse($tag, 200);
        } else {
            return new JsonResponse(null, 400);
        }
    }

    /**
     * Метод для получения тега по ID
     *
     * @return \Illuminate\Http\Response
     */
    public function get(string $id)
    {
        $tag = Tag::find($id);
        if (empty($tag)) {
            return new JsonResponse(null, 404);
        }
        return new JsonResponse($tag, 200);
    }

    /**
     * Метод для получения списка тегов
     *
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        $tags = Tag::all();
        $response = new JsonResponse($tags, 200);
        return $response;
    }

    /**
     * Метод для обновления тега по id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(string $id, Request $request)
    {
        $tag = Tag::find($id);
        if (empty($tag)) {
            $response = new JsonResponse(null, 404);
            return $response;
        }
        $tag->name = $request->name;
        if ($tag->save()) {
            return new JsonResponse($tag, 200);
        } else {
            return new JsonResponse(null, 400);
        }
    }

    /**
     * Метод для удаления тега по id
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(string $id)
    {
        $tag = Tag::find($id);
        if (empty($tag)) {
            return new JsonResponse(null, 404);
        } else {
            $tag->delete();
            return new JsonResponse(null, 200);
        }
    }
}
