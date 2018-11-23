<?php

use Illuminate\Database\Seeder;

use App\User;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert([
          'name' => str_random(rand(5, 15)),
        ]);
    }
}
