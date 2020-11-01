<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubordinationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lib_subordinations')->delete();
        DB::statement("insert into lib_subordinations(org_id,parent_org_id) values(1,14);");
        DB::statement("insert into lib_subordinations(org_id,parent_org_id) values(1,15);");
        DB::statement("insert into lib_subordinations(org_id,parent_org_id) values(2,16);");
        DB::statement("insert into lib_subordinations(org_id,parent_org_id) values(2,17);");
        DB::statement("insert into lib_subordinations(org_id,parent_org_id) values(3,16);");
        DB::statement("insert into lib_subordinations(org_id,parent_org_id) values(3,17);");
        DB::statement("insert into lib_subordinations(org_id,parent_org_id) values(4,18);");
        DB::statement("insert into lib_subordinations(org_id,parent_org_id) values(4,19);");
        DB::statement("insert into lib_subordinations(org_id,parent_org_id) values(5,20);");
        DB::statement("insert into lib_subordinations(org_id,parent_org_id) values(5,21);");
        DB::statement("insert into lib_subordinations(org_id,parent_org_id) values(6,20);");
        DB::statement("insert into lib_subordinations(org_id,parent_org_id) values(6,21);");
        DB::statement("insert into lib_subordinations(org_id,parent_org_id) values(7,22);");
        DB::statement("insert into lib_subordinations(org_id,parent_org_id) values(7,23);");
        DB::statement("insert into lib_subordinations(org_id,parent_org_id) values(8,22);");
        DB::statement("insert into lib_subordinations(org_id,parent_org_id) values(8,23);");
        DB::statement("insert into lib_subordinations(org_id,parent_org_id) values(9,22);");
        DB::statement("insert into lib_subordinations(org_id,parent_org_id) values(9,23);");
        DB::statement("insert into lib_subordinations(org_id,parent_org_id) values(10,24);");
        DB::statement("insert into lib_subordinations(org_id,parent_org_id) values(10,25);");
        DB::statement("insert into lib_subordinations(org_id,parent_org_id) values(11,26);");
        DB::statement("insert into lib_subordinations(org_id,parent_org_id) values(11,27);");
        DB::statement("insert into lib_subordinations(org_id,parent_org_id) values(1,28);");
        DB::statement("insert into lib_subordinations(org_id,parent_org_id) values(2,28);");
        DB::statement("insert into lib_subordinations(org_id,parent_org_id) values(3,28);");
        DB::statement("insert into lib_subordinations(org_id,parent_org_id) values(4,28);");
        DB::statement("insert into lib_subordinations(org_id,parent_org_id) values(5,28);");
        DB::statement("insert into lib_subordinations(org_id,parent_org_id) values(6,28);");
        DB::statement("insert into lib_subordinations(org_id,parent_org_id) values(7,28);");
        DB::statement("insert into lib_subordinations(org_id,parent_org_id) values(8,28);");
        DB::statement("insert into lib_subordinations(org_id,parent_org_id) values(9,28);");
        DB::statement("insert into lib_subordinations(org_id,parent_org_id) values(10,28);");
        DB::statement("insert into lib_subordinations(org_id,parent_org_id) values(11,28);");
        DB::statement("insert into lib_subordinations(org_id,parent_org_id) values(1,29);");
        DB::statement("insert into lib_subordinations(org_id,parent_org_id) values(2,29);");
        DB::statement("insert into lib_subordinations(org_id,parent_org_id) values(3,29);");
        DB::statement("insert into lib_subordinations(org_id,parent_org_id) values(4,29);");
        DB::statement("insert into lib_subordinations(org_id,parent_org_id) values(5,29);");
        DB::statement("insert into lib_subordinations(org_id,parent_org_id) values(6,29);");
        DB::statement("insert into lib_subordinations(org_id,parent_org_id) values(7,29);");
        DB::statement("insert into lib_subordinations(org_id,parent_org_id) values(8,29);");
        DB::statement("insert into lib_subordinations(org_id,parent_org_id) values(9,29);");
        DB::statement("insert into lib_subordinations(org_id,parent_org_id) values(10,29);");
        DB::statement("insert into lib_subordinations(org_id,parent_org_id) values(11,29);");
        DB::statement("insert into lib_subordinations(org_id,parent_org_id) values(12,29);");
        DB::statement("insert into lib_subordinations(org_id,parent_org_id) values(13,29);");

    }
}
