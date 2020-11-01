<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateLibVetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lib_vets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('vet_name',100);
            $table->timestamps();
        });
        //DB::statement("ALTER TABLE `lib_vets` comment 'Справочник Ветеринаров'");
        DB::statement("comment ON TABLE lib_vets IS 'Справочник Ветеринаров'");
        DB::statement("comment ON COLUMN lib_vets.vet_name IS 'ФИО ветеринарного врача'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lib_vets');
    }
}
