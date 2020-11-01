<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TailTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lib_tailtypes')->delete();
        DB::statement("insert into lib_tailtypes(id,tailtype_name) values(1,'Обычный');");
        DB::statement("insert into lib_tailtypes(id,tailtype_name) values(2,'Саблевидный ');");
        DB::statement("insert into lib_tailtypes(id,tailtype_name) values(3,'Крючком ');");
        DB::statement("insert into lib_tailtypes(id,tailtype_name) values(4,'Поленом ');");
        DB::statement("insert into lib_tailtypes(id,tailtype_name) values(5,'Прутом ');");
        DB::statement("insert into lib_tailtypes(id,tailtype_name) values(6,'Пером ');");
        DB::statement("insert into lib_tailtypes(id,tailtype_name) values(7,'Серпом');");
        DB::statement("insert into lib_tailtypes(id,tailtype_name) values(8,'Кольцом');");
        DB::statement("insert into lib_tailtypes(id,tailtype_name) values(9,'Купированный');");

        DB::statement("ALTER SEQUENCE lib_tailtypes_id_seq RESTART 10;");

    }
}
