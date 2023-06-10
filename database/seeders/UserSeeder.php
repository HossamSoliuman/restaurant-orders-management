<?php

namespace Database\Seeders;

use App\Models\Role;
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
        $roles=Role::all();
        foreach($roles as $role){
            $email=$role->name.'@gmail.com';
            User::factory()->create([
                'name' => $role->name,
                'email' => $email,
                'phone' => 1234+$role->id,
                'password' => Hash::make($email),
                'role_id' => $role->id
            ]);
        }

        User::factory(5)->create();
       

    }
}
