<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_groups')->delete();
        DB::statement("insert into role_groups(role_id,group_id) values(1,1);");
        DB::statement("insert into role_groups(role_id,group_id) values(1,2);");
        DB::statement("insert into role_groups(role_id,group_id) values(1,20);");

        DB::statement("insert into role_groups(role_id,group_id) values(4,3);");
        DB::statement("insert into role_groups(role_id,group_id) values(4,4);");
        DB::statement("insert into role_groups(role_id,group_id) values(4,5);");
        DB::statement("insert into role_groups(role_id,group_id) values(4,6);");
        DB::statement("insert into role_groups(role_id,group_id) values(4,7);");
        DB::statement("insert into role_groups(role_id,group_id) values(4,8);");
        DB::statement("insert into role_groups(role_id,group_id) values(4,9);");
        DB::statement("insert into role_groups(role_id,group_id) values(4,10);");
        DB::statement("insert into role_groups(role_id,group_id) values(4,11);");
        DB::statement("insert into role_groups(role_id,group_id) values(4,12);");
        DB::statement("insert into role_groups(role_id,group_id) values(4,13);");
        DB::statement("insert into role_groups(role_id,group_id) values(4,14);");
        DB::statement("insert into role_groups(role_id,group_id) values(4,15);");
        DB::statement("insert into role_groups(role_id,group_id) values(4,16);");
        DB::statement("insert into role_groups(role_id,group_id) values(4,20);");
        DB::statement("insert into role_groups(role_id,group_id) values(4,21);");

        DB::statement("insert into role_groups(role_id,group_id) values(5,3);");
        DB::statement("insert into role_groups(role_id,group_id) values(5,4);");
        DB::statement("insert into role_groups(role_id,group_id) values(5,5);");
        DB::statement("insert into role_groups(role_id,group_id) values(5,6);");
        DB::statement("insert into role_groups(role_id,group_id) values(5,7);");
        DB::statement("insert into role_groups(role_id,group_id) values(5,8);");
        DB::statement("insert into role_groups(role_id,group_id) values(5,9);");
        DB::statement("insert into role_groups(role_id,group_id) values(5,10);");
        DB::statement("insert into role_groups(role_id,group_id) values(5,11);");
        DB::statement("insert into role_groups(role_id,group_id) values(5,12);");
        DB::statement("insert into role_groups(role_id,group_id) values(5,13);");
        DB::statement("insert into role_groups(role_id,group_id) values(5,14);");
        DB::statement("insert into role_groups(role_id,group_id) values(5,15);");
        DB::statement("insert into role_groups(role_id,group_id) values(5,16);");
        DB::statement("insert into role_groups(role_id,group_id) values(5,17);");
        DB::statement("insert into role_groups(role_id,group_id) values(5,18);");
        DB::statement("insert into role_groups(role_id,group_id) values(5,19);");
        DB::statement("insert into role_groups(role_id,group_id) values(5,21);");


        DB::statement("insert into role_groups(role_id,group_id) values(2,3);");
        DB::statement("insert into role_groups(role_id,group_id) values(2,4);");
        DB::statement("insert into role_groups(role_id,group_id) values(2,5);");
        DB::statement("insert into role_groups(role_id,group_id) values(2,6);");
        DB::statement("insert into role_groups(role_id,group_id) values(2,7);");
        DB::statement("insert into role_groups(role_id,group_id) values(2,8);");
        DB::statement("insert into role_groups(role_id,group_id) values(2,9);");
        DB::statement("insert into role_groups(role_id,group_id) values(2,10);");
        DB::statement("insert into role_groups(role_id,group_id) values(2,11);");
        DB::statement("insert into role_groups(role_id,group_id) values(2,12);");
        DB::statement("insert into role_groups(role_id,group_id) values(2,13);");
        DB::statement("insert into role_groups(role_id,group_id) values(2,14);");
        DB::statement("insert into role_groups(role_id,group_id) values(2,15);");
        DB::statement("insert into role_groups(role_id,group_id) values(2,16);");
        DB::statement("insert into role_groups(role_id,group_id) values(2,20);");
        DB::statement("insert into role_groups(role_id,group_id) values(2,21);");

        DB::statement("insert into role_groups(role_id,group_id) values(3,3);");
        DB::statement("insert into role_groups(role_id,group_id) values(3,4);");
        DB::statement("insert into role_groups(role_id,group_id) values(3,5);");
        DB::statement("insert into role_groups(role_id,group_id) values(3,6);");
        DB::statement("insert into role_groups(role_id,group_id) values(3,7);");
        DB::statement("insert into role_groups(role_id,group_id) values(3,8);");
        DB::statement("insert into role_groups(role_id,group_id) values(3,9);");
        DB::statement("insert into role_groups(role_id,group_id) values(3,10);");
        DB::statement("insert into role_groups(role_id,group_id) values(3,11);");
        DB::statement("insert into role_groups(role_id,group_id) values(3,12);");
        DB::statement("insert into role_groups(role_id,group_id) values(3,13);");
        DB::statement("insert into role_groups(role_id,group_id) values(3,14);");
        DB::statement("insert into role_groups(role_id,group_id) values(3,15);");
        DB::statement("insert into role_groups(role_id,group_id) values(3,16);");
        DB::statement("insert into role_groups(role_id,group_id) values(3,20);");
        DB::statement("insert into role_groups(role_id,group_id) values(3,21);");

    }
}
