<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SizesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lib_sizes')->delete();
        DB::statement("insert into lib_sizes(id,size_name) values(1,'Маленький ');");
        DB::statement("insert into lib_sizes(id,size_name) values(2,'Средний');");
        DB::statement("insert into lib_sizes(id,size_name) values(3,'Большой');");
        DB::statement("insert into lib_sizes(id,size_name) values(4,'Крупный');");

        DB::statement("ALTER SEQUENCE lib_sizes_id_seq RESTART 5;");

    }
}
