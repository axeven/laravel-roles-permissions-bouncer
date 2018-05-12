<?php

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
            $table->string('email');
            $table->string('password');
            $table->string('remember_token')->nullable();

            $table->timestamps();

            $table->unique('email', 'unique_email');
            $table->index(['email', 'password'], 'index_login');
            $table->index('created_at', 'index_user_sort_created');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique('unique_email');
            $table->dropIndex('index_login');
            $table->dropIndex('index_user_sort_created');
        });
        Schema::dropIfExists('users');
    }
}
