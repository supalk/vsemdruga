<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateLibKindsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lib_kinds', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kind_name',20);
            $table->timestamps();
        });
        //DB::statement("ALTER TABLE `lib_kinds` comment 'Справочник видов жевотных'");
        DB::statement("comment ON TABLE lib_kinds IS 'Справочник видов животных'");
        DB::statement("comment ON COLUMN lib_kinds.kind_name IS 'Наименование вида животного'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lib_kinds');
    }
}
