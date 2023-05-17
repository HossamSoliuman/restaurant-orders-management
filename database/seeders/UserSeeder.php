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
        //seed admin
        $adminEmail='admin@gmail.com';
        User::factory()->create([
            'name' => 'admin',
            'email' => $adminEmail,
            'phone' => 1234,
            'password' => Hash::make($adminEmail),
            'role_id' => 2
        ]);
        //user
        $adminEmail='user@gmail.com';
        User::factory()->create([
            'name' => 'user',
            'email' => $adminEmail,
            'phone' => 1234,
            'password' => Hash::make($adminEmail),
            'role_id' => 1
        ]);
        //other users
        User::factory(5)->create();
       

    }
}
