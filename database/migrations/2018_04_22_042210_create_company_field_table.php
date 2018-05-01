<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyFieldTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_field', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
            $table->unique('name', 'unique_company_field_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_field', function (Blueprint $table) {
            $m = Schema::getConnection()->getDoctrineSchemaManager();
            $indexes = $m->listTableIndexes('company_field');
            if (array_key_exists("unique_company_field_name", $indexes)) {
                $table->dropUnique("unique_company_field_name");
            }

        });
        Schema::dropIfExists('company_field');
    }
}
