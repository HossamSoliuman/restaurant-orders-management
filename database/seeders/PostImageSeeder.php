<?php

namespace Database\Seeders;

use App\Models\PostImage;
use Database\Factories\PostImageFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PostImage::factory(50)->create();
    }
}
