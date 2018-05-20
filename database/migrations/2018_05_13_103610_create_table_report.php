<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableReport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unsigned();
            $table->integer('hr');
            $table->integer('finance');
            $table->integer('sales');
            $table->integer('marketing');
            $table->timestamps();

            $table->index('user_id', 'index_report_user_id');
            $table->index('hr', 'index_report_hr');
            $table->index('finance', 'index_report_finance');
            $table->index('sales', 'index_report_sales');
            $table->index('marketing', 'index_report_marketing');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('report', function (Blueprint $table) {

            $table->dropForeign('report_user_id_foreign');

            $table->dropIndex('index_report_user_id');
            $table->dropIndex('index_report_hr');
            $table->dropIndex('index_report_finance');
            $table->dropIndex('index_report_sales');
            $table->dropIndex('index_report_marketing');

        });
        Schema::dropIfExists('report');
    }
}
