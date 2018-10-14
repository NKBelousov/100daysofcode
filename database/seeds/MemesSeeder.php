<?php

use Illuminate\Database\Seeder;

use App\User;

class MemesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $randomUser = User::inRandomOrder()->first();
        DB::table('memes')->insert([
            'title' => str_random(10),
            'description' => str_random(50),
            'user_id' => $randomUser->id,
        ]);
    }
}
