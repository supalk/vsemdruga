<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EuthanasiasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lib_reason_euthanasias')->delete();
        DB::statement("insert into lib_reason_euthanasias(id,euthanasia_name) values(1,'Заболевание, несовместимое с жизнью');");
        DB::statement("insert into lib_reason_euthanasias(id,euthanasia_name) values(2,'Травма, несовместимая с жизнью');");

        DB::statement("ALTER SEQUENCE lib_reason_euthanasias_id_seq RESTART 3;");
    }
}
