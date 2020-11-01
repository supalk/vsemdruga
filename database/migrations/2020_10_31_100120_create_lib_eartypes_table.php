<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateLibEartypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lib_eartypes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('eartype_name',100);
            $table->timestamps();
        });
        //DB::statement("ALTER TABLE `lib_eartypes` comment 'Справочник типов ушей'");
        DB::statement("comment ON TABLE lib_eartypes IS 'Справочник типов ушей'");
        DB::statement("comment ON COLUMN lib_eartypes.eartype_name IS 'Наименование'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lib_eartypes');
    }
}
