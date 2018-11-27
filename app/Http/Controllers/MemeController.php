<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Meme;
use App\Tag;

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

    public function updateTags(string $id, Request $request)
    {
        $tags = $request->all();
        try {
            $meme = Meme::find($id);
            $ids = [];
            foreach ($tags as $value) {
                $tag = Tag::where([
                    'name' => $value,
                ])->first();
                if (empty($tag)) {
                    $tag = new Tag();
                    $tag->name = $value;
                    $tag->save();
                }
                $ids[] = $tag->id;
            }
            $meme->tags()->sync($ids);
            return new JsonResponse($meme->tags, 200);
        } catch (\Illuminate\Database\QueryException $e) {
            return new JsonResponse($e, 400);
        }
    }
}
