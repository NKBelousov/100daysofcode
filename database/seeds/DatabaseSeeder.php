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
        for ($i = 0; $i < 100; $i++) {
            echo "Iteration $i \n";
            $this->call(UsersSeeder::class);
            $this->call(MemesSeeder::class);
            $this->call(GradesSeeder::class);
        }
    }
}
