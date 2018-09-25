<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fours', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->unique();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('email_address')->nullable();
            $table->string('name')->nullable();
            $table->string('university_email_address')->nullable();
            $table->string('university_website')->nullable();
            $table->string('undergraduate_major')->nullable();
            $table->string('graduation_year')->nullable();
            $table->string('university_ambassadors')->nullable();
            $table->string('ethereum_address')->nullable();
            $table->string('point')->default(0)->nullable();
            $table->string('ip')->nullable();
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
        Schema::drop('fours');
    }
}
