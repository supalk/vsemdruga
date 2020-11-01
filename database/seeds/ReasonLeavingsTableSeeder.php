<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReasonLeavingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lib_reason_leavings')->delete();
        DB::statement("insert into lib_reason_leavings(id,leaving_name) values(1,'Передача в собственность (под опеку)');");
        DB::statement("insert into lib_reason_leavings(id,leaving_name) values(2,'Смерть');");

        DB::statement("ALTER SEQUENCE lib_reason_leavings_id_seq RESTART 3;");
    }
}
