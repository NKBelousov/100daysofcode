<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Meme;

class FavoritesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $randomUser = User::inRandomOrder()->first();
        $randomMeme = Meme::inRandomOrder()->first();
        DB::table('favorites')->insert([
            'user_id' => $randomUser->id,
            'meme_id' => $randomMeme->id,
        ]);
    }
}
