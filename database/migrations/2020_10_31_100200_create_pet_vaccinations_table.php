<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
class CreatePetVaccinationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pet_vaccinations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pet_id')->unsigned();
            $table->foreign('pet_id')->references('id')->on('pets')->onUpdate('cascade')->onDelete('cascade');
            $table->date('event_date');
            $table->string('type',255);
            $table->string('serial',20)->nullable();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
        });

        DB::statement("comment ON TABLE pet_vaccinations IS 'Вакцинации'");
        DB::statement("comment ON COLUMN pet_vaccinations.event_date IS 'Дата вакцинации'");
        DB::statement("comment ON COLUMN pet_vaccinations.type IS 'Вид вакцины'");
        DB::statement("comment ON COLUMN pet_vaccinations.serial IS 'Номер серии вакцины'");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pet_vaccinations');
    }
}
