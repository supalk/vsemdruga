<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
class CreateLibTailtypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lib_tailtypes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tailtype_name',100);
            $table->timestamps();
        });
        //DB::statement("ALTER TABLE `lib_tailtypes` comment 'Справочник типов хвостов'");
        DB::statement("comment ON TABLE lib_tailtypes IS 'Справочник типов хвостов'");
        DB::statement("comment ON COLUMN lib_tailtypes.tailtype_name IS 'Наименование'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lib_tailtypes');
    }
}
