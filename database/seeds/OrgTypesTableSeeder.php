<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrgTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lib_orgtypes')->delete();
        DB::statement("insert into lib_orgtypes(id,type_name) values(1,'Приют');");
        DB::statement("insert into lib_orgtypes(id,type_name) values(2,'Префектура');");
        DB::statement("insert into lib_orgtypes(id,type_name) values(3,'Эксплуатирующие оргганизации');");
        DB::statement("insert into lib_orgtypes(id,type_name) values(4,'ДЖКХ города Москвы');");

        DB::statement("ALTER SEQUENCE lib_orgtypes_id_seq RESTART 5;");

    }
}
