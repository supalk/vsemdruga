<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReasonDethsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lib_reason_deaths')->delete();
        DB::statement("insert into lib_reason_deaths(id,death_name) values(1,'Естественная смерть');");
        DB::statement("insert into lib_reason_deaths(id,death_name) values(2,'Эвтаназия');");

        DB::statement("ALTER SEQUENCE lib_reason_deaths_id_seq RESTART 3;");

    }
}
