<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'contact' => '9824115186',
            'role' => 'admin'
        ]);

        $user = User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make('user123'),
            'contact' => '9824115185',
            'role' => 'user'
        ]);



        
        // $faker = Faker::create();
        //     // $user = new User;
        //     // $user->name = $faker->name;
        //     // $user->email = $faker->email;
        //     // $user->password = bcrypt($faker->password);
        //     // $user->contact = $faker->phoneNumber;
        //     // $user->save();

        // for ($i = 1; $i <= 10; $i++) {
        //     $user = new User;
        //     $user->name = $faker->name;
        //     $user->email = $faker->email;
        //     $user->password = bcrypt($faker->password);
        //     $user->contact = $faker->phoneNumber;
        //     $user->save();
        // }

     
        // $user = new user;
        // $user->name = 'anjana';
        // $user->email = 'anjanakunwar21@gmail.com';
        // $user->password = 'anjana123';
        // $user->contact = '9824115186';
        // $user->save();

    }
}
