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
        $userEmail='user@gmail.com';
        User::factory()->create([
            'name' => 'user',
            'email' => $userEmail,
            'phone' => 12345,
            'password' => Hash::make($userEmail),
            'role_id' => 1
        ]);
         //reviewer
         $reviewerEmail='reviewer@gmail.com';
         User::factory()->create([
             'name' => 'reviewer',
             'email' => $reviewerEmail,
             'phone' =>12346,
             'password' => Hash::make($reviewerEmail),
             'role_id' => 3
         ]);
          //chef
        $chefEmail='chef@gmail.com';
        User::factory()->create([
            'name' => 'chef',
            'email' => $chefEmail,
            'phone' => 12347,
            'password' => Hash::make($chefEmail),
            'role_id' => 4
        ]);
         //delivery
         $deliveryEmail='deliveryEmail@gmail.com';
         User::factory()->create([
             'name' => 'delivery',
             'email' => $deliveryEmail,
             'phone' => 12348,
             'password' => Hash::make($deliveryEmail),
             'role_id' => 5
         ]);
        //other users
        User::factory(5)->create();
       

    }
}
