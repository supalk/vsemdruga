<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KindsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lib_kinds')->delete();
        DB::statement("insert into lib_kinds(id,kind_name) values(1,'Кошка');");
        DB::statement("insert into lib_kinds(id,kind_name) values(2,'Собака');");

        DB::statement("ALTER SEQUENCE lib_kinds_id_seq RESTART 3;");
    }
}
