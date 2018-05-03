<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sentence');
            $table->integer('score');
            $table->integer('order');
            $table->integer('question_id')->unsigned();
            $table->foreign('question_id')->references('id')->on('question')->onDelete('cascade');
            $table->index('question_id', 'index_question_id');
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
        Schema::table('answer', function(Blueprint $table){
            $table->dropForeign('answer_question_id_foreign');
            $table->dropIndex('index_question_id');
        });
        Schema::dropIfExists('answer');
    }
}
