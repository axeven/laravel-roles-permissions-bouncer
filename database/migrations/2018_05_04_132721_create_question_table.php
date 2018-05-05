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
            $table->integer('order');
            $table->enum('type', ['text', 'textarea', 'select-single', 'select-multiple']);
            $table->integer('section_id')->unsigned();
            $table->foreign('section_id')->references('id')->on('section')->onDelete('cascade');
            $table->index('section_id', 'index_section_id');
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
            $table->dropForeign('question_section_id_foreign');
            $table->dropIndex('index_section_id');
        });
        Schema::dropIfExists('question');
    }
}
