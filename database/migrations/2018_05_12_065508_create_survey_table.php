<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurveyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survey', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unsigned();
            $table->integer('question_id')->unsigned();
            $table->integer('answer_id')->unsigned()->nullable();

            $table->text('valtext');

            $table->index('user_id', 'index_survey_user_id');
            $table->index('question_id', 'index_survey_question_id');
            $table->index('answer_id', 'index_survey_answer_id');

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
        Schema::table('survey', function (Blueprint $table) {
            $table->dropIndex('index_survey_user_id');
            $table->dropIndex('index_survey_question_id');
            $table->dropIndex('index_survey_answer_id');
        });
        Schema::dropIfExists('survey');
    }
}
