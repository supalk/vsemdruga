<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
class CreateLibWooltypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lib_wooltypes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('wooltype_name',100);
            $table->integer('kind_id')->unsigned();
            $table->foreign('kind_id')->references('id')->on('lib_kinds')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
        //DB::statement("ALTER TABLE `lib_wooltypes` comment 'Справочник типов шерсти'");
        DB::statement("comment ON TABLE lib_wooltypes IS 'Справочник типов шерсти'");
        DB::statement("comment ON COLUMN lib_wooltypes.wooltype_name IS 'Наименование'");
        DB::statement("comment ON COLUMN lib_wooltypes.kind_id IS 'Вид животного'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lib_wooltypes');
    }
}
