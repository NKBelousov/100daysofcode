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
        $tag = Tag::inRandomOrder()->first()->id;
        $meme = Meme::inRandomOrder()->first()->id;

        DB::table('memes_tags')->insert([
            'tag_id' => $tag,
            'meme_id' => $meme,
        ]);
    }
}
