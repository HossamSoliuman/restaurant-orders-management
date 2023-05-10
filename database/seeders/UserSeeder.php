<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $email='admin@gmail.com';
        //seed admin
        User::factory()->create([
            'name' => 'admin',
            'email' => $email,
            'password' => Hash::make($email),
            'role_id' => 2
        ]);
        //other users
        User::factory(5)->create();
       

    }
}
