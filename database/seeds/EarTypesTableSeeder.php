<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EarTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lib_eartypes')->delete();
        DB::statement("insert into lib_eartypes(id,eartype_name) values(1,'Стоячие ');");
        DB::statement("insert into lib_eartypes(id,eartype_name) values(2,'Полустоячие ');");
        DB::statement("insert into lib_eartypes(id,eartype_name) values(3,'Висячие ');");
        DB::statement("insert into lib_eartypes(id,eartype_name) values(4,'Купированные ');");

        DB::statement("ALTER SEQUENCE lib_eartypes_id_seq RESTART 5;");
    }
}
