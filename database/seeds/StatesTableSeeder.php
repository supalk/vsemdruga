<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pet_states')->delete();
        DB::statement("insert into pet_states(id,state_name) values(1,'Прибыл в приют');");
        DB::statement("insert into pet_states(id,state_name) values(2,'Готов к социализации');");
        DB::statement("insert into pet_states(id,state_name) values(3,'Выбыл');");

        DB::statement("ALTER SEQUENCE pet_states_id_seq RESTART 4;");

    }
}
