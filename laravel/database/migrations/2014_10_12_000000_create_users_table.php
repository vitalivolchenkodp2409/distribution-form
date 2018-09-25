<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password')->default(bcrypt('123456'));
            $table->string('type')->nullable();
            $table->string('avatar')->nullable();
            $table->string('point')->default('0')->nullable();
            $table->integer('form_level')->default(0)->nullable();
            $table->string('ip')->nullable();
            $table->float('arrows')->nullable();
            $table->float('karma')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
