<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdministratorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('administrators', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->string('auth_token')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        \Illuminate\Support\Facades\DB::table('administrators')->insert([
            'name' => 'Vital Ozierski',
            'email' => 'admin@ozitag.com',
            'password' => \Illuminate\Support\Facades\Hash::make('admin'),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('administrators');
    }
}
