<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateLibReasonLeavingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lib_reason_leavings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('leaving_name',255);
            $table->timestamps();
        });
        //DB::statement("ALTER TABLE `lib_reason_leavings` comment 'Справочник причин выбытия из приюта'");
        DB::statement("comment ON TABLE lib_reason_leavings IS 'Справочник причин выбытия из приюта'");
        DB::statement("comment ON COLUMN lib_reason_leavings.leaving_name IS 'Наименование причины'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lib_reason_leavings');
    }
}
