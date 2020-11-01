<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePetTreatmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pet_treatments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pet_id')->unsigned();
            $table->foreign('pet_id')->references('id')->on('pets')->onUpdate('cascade')->onDelete('cascade');
            $table->date('event_date');
            $table->string('drug',255);
            $table->string('dose',50)->nullable();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });

        DB::statement("comment ON TABLE pet_treatments IS 'Сведения об обработке от экто- и эндопаразитов'");
        DB::statement("comment ON COLUMN pet_treatments.event_date IS 'Дата обработки'");
        DB::statement("comment ON COLUMN pet_treatments.drug IS 'Наименование препарата'");
        DB::statement("comment ON COLUMN pet_treatments.dose IS 'Доза'");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pet_treatments');
    }
}
