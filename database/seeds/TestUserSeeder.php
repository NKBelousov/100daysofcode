<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\User;

class TestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $email = str_random(10) . '@' . str_random(10) . '.com';
        $pass = str_random(10);
        $payload = [
          'name' => str_random(10),
          'email' => $email,
          'password' => Hash::make($pass),
        ];
        $randomUser = User::create($payload);
        if ($randomUser->save()) {
            echo "\nGenerated user: \n";
            echo "  $email\n";
            echo "  $pass\n\n";
        }
    }
}
