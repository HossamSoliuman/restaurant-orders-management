<?php

namespace Database\Seeders;

use App\Models\OrderAddress;
use Illuminate\Database\Seeder;

class OrderAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrderAddress::factory(5)->create();
    }
}
