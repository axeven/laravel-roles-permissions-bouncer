<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
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
    }
}
