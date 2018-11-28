<?php

use Illuminate\Database\Seeder;

use App\Tag;
use App\Meme;

class MemeTagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tag = Tag::inRandomOrder()->first();
        $meme = Meme::inRandomOrder()->first();

        if (empty($meme->tags()->find($tag->id))) {
            $meme->tags()->attach($tag->id);
        }
    }
}
