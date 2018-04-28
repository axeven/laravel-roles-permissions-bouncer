<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanySizeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_size', function (Blueprint $table) {
            $table->increments('id');
            $table->string('label');
            $table->timestamps();
            $table->index('label', 'index_company_size_label');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_size', function (Blueprint $table) {
            $m = Schema::getConnection()->getDoctrineSchemaManager();
            $indexes = $m->listTableIndexes('company_size');
            if(array_key_exists("index_company_size_label", $indexes))
                $table->dropIndex("index_company_size_label");
        });

        Schema::dropIfExists('company_size');
    }
}
