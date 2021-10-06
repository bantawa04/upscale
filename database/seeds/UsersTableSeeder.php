<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */   
    public function run()
    {
        $faker = Faker\Factory::create();
        $user = new User;
        $user->name = $faker->name;
        $user->email = 'rahunn3@gmail.com';
        $user->password = bcrypt('password');
        $user->type = 'admin';
        $user->save();
        echo 'User seed complete';
    }
}
