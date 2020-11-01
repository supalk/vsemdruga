<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateLibReasonEuthanasiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lib_reason_euthanasias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('euthanasia_name',255);
            $table->timestamps();
        });
        //DB::statement("ALTER TABLE `lib_reason_euthanasias` comment 'Справочник причин эвтаназии'");
        DB::statement("comment ON TABLE lib_reason_euthanasias IS 'Справочник причин эвтаназии'");
        DB::statement("comment ON COLUMN lib_reason_euthanasias.euthanasia_name IS 'Наименование причины'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lib_reason_euthanasias');
    }
}
