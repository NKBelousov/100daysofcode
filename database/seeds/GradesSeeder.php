<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Meme;

class GradesSeeder extends Seeder
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
        $randomValue = rand(0, 10) > 5 ? "positive" : "negative";
        DB::table('grades')->insert([
            'value' => $randomValue,
            'user_id' => $randomUser->id,
            'meme_id' => $randomMeme->id,
        ]);
    }
}
