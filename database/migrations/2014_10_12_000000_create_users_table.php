<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->date('date_of_birth');
            $table->enum('gender', ['m', 'f'])->default('m');
            $table->string('profile_picture')->nullable();
            $table->string('username');
            $table->string('password');
            $table->string('about')->nullable();
            $table->integer('rating')->nullable();
            $table->enum('status',['active', 'deactivate'])->default('active');
            $table->integer('role_id');
            $table->string('token');
            $table->dateTime('token_generate_time', $precision = 0);
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
};
