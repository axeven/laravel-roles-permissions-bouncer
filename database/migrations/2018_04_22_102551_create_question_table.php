<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question', function (Blueprint $table) {
            $table->increments('id');
            $table->string('label');
            $table->unique('label', 'unique_question_label');
            $table->string('sentence');
            $table->enum('choosability', ['single', 'multiple']);
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
        Schema::table('question', function(Blueprint $table){
            $table->dropIndex('unique_question_label');
        });
        Schema::dropIfExists('question');
    }
}
