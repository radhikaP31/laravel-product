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
        Schema::table('users', function (Blueprint $table) {
            $table->string('email_verified_at')->nullable()->change();
            $table->string('token')->nullable()->change();
            $table->string('token_generate_time')->nullable()->change();
            $table->string('remember_token')->nullable()->change();
            $table->string('created_at')->nullable()->change();
            $table->string('updated_at')->nullable()->change();
        });

        Schema::table('roles', function (Blueprint $table) {
            $table->dropColumn('created');
            $table->dropColumn('modified');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->date('created');
            $table->date('modified');
        });
    }
};
