<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateLibReasonDeathsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lib_reason_deaths', function (Blueprint $table) {
            $table->increments('id');
            $table->string('death_name',255);
            $table->timestamps();
        });
        //DB::statement("ALTER TABLE `lib_reason_deaths` comment 'Справочник причин смерти'");
        DB::statement("comment ON TABLE lib_reason_deaths IS 'Справочник причин смерти'");
        DB::statement("comment ON COLUMN lib_reason_deaths.death_name IS 'Наименование причины'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lib_reason_deaths');
    }
}
