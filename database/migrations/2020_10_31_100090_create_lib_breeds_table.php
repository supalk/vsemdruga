<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateLibBreedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lib_breeds', function (Blueprint $table) {
            $table->increments('id');
            $table->string('breed_name',100);
            $table->integer('kind_id')->unsigned();
            $table->foreign('kind_id')->references('id')->on('lib_kinds')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
        //DB::statement("ALTER TABLE `lib_breeds` comment 'Справочник пород'");
        DB::statement("comment ON TABLE lib_breeds IS 'Справочник пород'");
        DB::statement("comment ON COLUMN lib_breeds.breed_name IS 'Наименование пород животного'");
        DB::statement("comment ON COLUMN lib_breeds.kind_id IS 'Вид животного'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lib_breeds');
    }
}
