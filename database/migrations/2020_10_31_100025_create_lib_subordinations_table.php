<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLibSubordinationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lib_subordinations', function (Blueprint $table) {
            $table->integer('org_id')->unsigned();
            $table->foreign('org_id')->references('id')->on('lib_organizations')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('parent_org_id')->unsigned();
            $table->foreign('parent_org_id')->references('id')->on('lib_organizations')->onUpdate('cascade')->onDelete('cascade');
            $table->primary(['org_id','parent_org_id']);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lib_subordinations');
    }
}
