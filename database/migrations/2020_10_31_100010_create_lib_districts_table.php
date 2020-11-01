<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLibDistrictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lib_districts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('district_name',255)/*->comment('Наименование округов')*/;
            $table->string('district_short_name',255)->nullable()/*->comment('Сокращённое наименование округов')*/;
        });
        //DB::statement("ALTER TABLE lib_districts comment 'Справочник административных районов'");
        DB::statement("comment ON TABLE lib_districts IS 'Справочник административных районов'");
        DB::statement("comment ON COLUMN lib_districts.district_name IS 'Наименование округов'");
        DB::statement("comment ON COLUMN lib_districts.district_short_name IS 'Сокращённое наименование округов'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lib_districts');
    }
}
