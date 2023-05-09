<?php

namespace Database\Seeders;

use App\Models\MenuItem;
use App\Models\MenuItemImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuItemImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MenuItemImage::factory(70)->create();
    }
}
