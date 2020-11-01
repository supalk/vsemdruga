<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistrictsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lib_districts')->delete();
        DB::statement("insert into lib_districts(id,district_name,district_short_name) values(1,'Юго-Западный административный округ','ЮЗАО');");
        DB::statement("insert into lib_districts(id,district_name,district_short_name) values(2,'Юго-Восточный административный округ','ЮВАО');");
        DB::statement("insert into lib_districts(id,district_name,district_short_name) values(3,'Западный административный округ','ЗАО');");
        DB::statement("insert into lib_districts(id,district_name,district_short_name) values(4,'Северный административный округ','САО');");
        DB::statement("insert into lib_districts(id,district_name,district_short_name) values(5,'Северо-Восточный административный округ','СВАО');");
        DB::statement("insert into lib_districts(id,district_name,district_short_name) values(6,'Восточный административный округ','ВАО');");
        DB::statement("insert into lib_districts(id,district_name,district_short_name) values(7,'Южный административный округ','ЮАО');");
        DB::statement("insert into lib_districts(id,district_name,district_short_name) values(8,'Центральный административный округ','ЦАО');");
        DB::statement("insert into lib_districts(id,district_name,district_short_name) values(9,'Северо-Западный административный округ','СЗАО');");
        DB::statement("insert into lib_districts(id,district_name,district_short_name) values(10,'Зеленоградский административный округ','ЗелАО');");

        DB::statement("ALTER SEQUENCE lib_districts_id_seq RESTART 11;");

    }
}
