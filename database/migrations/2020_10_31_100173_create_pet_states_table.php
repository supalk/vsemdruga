<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePetStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pet_states', function (Blueprint $table) {
            $table->increments('id');
            $table->string('state_name',100);
            $table->timestamps();
        });
        //DB::statement("comment ON TABLE pet_states IS ''");
        //DB::statement("comment ON COLUMN pet_states.state_name IS ''");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pet_states');
    }
}
