<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateLibSizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lib_sizes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('size_name',100);
            $table->timestamps();
        });
        //DB::statement("comment ON TABLE lib_sizes IS ''");
        DB::statement("comment ON COLUMN lib_sizes.size_name IS 'Наименование размера'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lib_sizes');
    }
}
