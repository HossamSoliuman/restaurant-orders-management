<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        DB::table('roles')->insert([
            ['id' => 1, 'name' => 'user'],
            ['id' => 2, 'name' => 'admin'],
            ['id' => 3, 'name' => 'reviewer'],
            ['id' => 4, 'name' => 'chef'],
            ['id' => 5, 'name' => 'delivery'],
        ]);
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
};
