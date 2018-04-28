<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyModelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_model', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();

            $table->index('name', 'index_company_model_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_model', function (Blueprint $table) {
            $m = Schema::getConnection()->getDoctrineSchemaManager();
            $indexes = $m->listTableIndexes('company_model');
            if(array_key_exists("index_company_model_name", $indexes))
                $table->dropIndex("index_company_model_name");
        });
        Schema::dropIfExists('company_model');
    }
}
