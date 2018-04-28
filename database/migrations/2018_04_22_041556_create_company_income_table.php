<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyIncomeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_income', function (Blueprint $table) {
            $table->increments('id');
            $table->string('label');
            $table->timestamps();
            $table->index('label', 'index_company_income_label');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_income', function (Blueprint $table) {
            $m = Schema::getConnection()->getDoctrineSchemaManager();
            $indexes = $m->listTableIndexes('company_income');
            if(array_key_exists("index_company_income_label", $indexes))
                $table->dropIndex("index_company_income_label");
        });

        Schema::dropIfExists('company_income');
    }
}
