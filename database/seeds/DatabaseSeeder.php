<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            $this->call(TestUserSeeder::class);
            $this->call(UsersSeeder::class);
            $this->call(TagsSeeder::class);

            for ($j = 0; $j < 5; $j++) {
                $this->call(MemesSeeder::class);
                if (rand(0, 100) > 50) {
                    $this->call(TagsSeeder::class);
                }
                if (rand(0, 100) > 50) {
                    $this->call(MemeTagsSeeder::class);
                }
                if (rand(0, 100) > 50) {
                    $this->call(GradesSeeder::class);
                }
                if (rand(0, 100) > 50) {
                    $this->call(FavoritesSeeder::class);
                }
            }
        }
    }
}
