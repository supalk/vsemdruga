<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WoolsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lib_wooltypes')->delete();
        DB::statement("insert into lib_wooltypes(id,kind_id,wooltype_name) values(1,2,'Обычная ');");
        DB::statement("insert into lib_wooltypes(id,kind_id,wooltype_name) values(2,2,'Длинная');");
        DB::statement("insert into lib_wooltypes(id,kind_id,wooltype_name) values(3,2,'Гладкая');");
        DB::statement("insert into lib_wooltypes(id,kind_id,wooltype_name) values(4,2,'Вьющаяся');");
        DB::statement("insert into lib_wooltypes(id,kind_id,wooltype_name) values(5,2,'Жесткая ');");
        DB::statement("insert into lib_wooltypes(id,kind_id,wooltype_name) values(6,2,'Бесшерстная');");
        DB::statement("insert into lib_wooltypes(id,kind_id,wooltype_name) values(7,2,'Нетипичная ');");
        DB::statement("insert into lib_wooltypes(id,kind_id,wooltype_name) values(8,1,'Короткая');");
        DB::statement("insert into lib_wooltypes(id,kind_id,wooltype_name) values(9,1,'Длинная ');");
        DB::statement("insert into lib_wooltypes(id,kind_id,wooltype_name) values(10,1,'Бесшерстная');");

        DB::statement("ALTER SEQUENCE lib_wooltypes_id_seq RESTART 11;");

    }
}
