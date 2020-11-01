<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();

        $rec = new Role();
        $rec->id=1;
        $rec->name='Сотрудник приюта';
        $rec->save();

        $rec = new Role();
        $rec->id=2;
        $rec->name='Специалист по фауне префектуры административного округа';
        $rec->save();

        $rec = new Role();
        $rec->id=3;
        $rec->name='Специалист эксплуатирующих организаций';
        $rec->save();

        $rec = new Role();
        $rec->id=4;
        $rec->name='Работник ДЖКХ г.Москвы';
        $rec->save();

        $rec = new Role();
        $rec->id=5;
        $rec->name='Администратор Системы';
        $rec->save();

        DB::statement("ALTER SEQUENCE roles_id_seq RESTART 6;");
    }
}
