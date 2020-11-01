<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        //$role_admin = Role::all();
        //$role_manager  = Role::where('name', 'is_select_rec')->first();

        $employee = new User();
        $employee->user_name = 'Пользователь 1';
        $employee->email = 'supalk@mail.ru';
        $employee->password = bcrypt('1111');
        $employee->role_id = 1;
        $employee->org_id = 1;
        $employee->enable = 1;
        $employee->save();

        $employee = new User();
        $employee->user_name = 'Пользователь 2';
        $employee->email = 'fors212507@ya.ru';
        $employee->password = bcrypt('3319');
        $employee->role_id = 1;
        $employee->org_id = 1;
        $employee->enable = 1;
        $employee->save();

        $employee = new User();
        $employee->user_name = 'Пользователь Админ';
        $employee->email = 'admin@vsemdruga.ru';
        $employee->password = bcrypt('1111');
        $employee->role_id = 5;
        $employee->org_id = 28;
        $employee->enable = 1;
        $employee->save();

        $employee = new User();
        $employee->user_name = 'Пользователь ДЖКХ';
        $employee->email = 'dgkh@vsemdruga.ru';
        $employee->password = bcrypt('1111');
        $employee->role_id = 4;
        $employee->org_id = 28;
        $employee->enable = 1;
        $employee->save();

        $employee = new User();
        $employee->user_name = 'Пользователь эксп. орг';
        $employee->email = 'eo@vsemdruga.ru';
        $employee->password = bcrypt('1111');
        $employee->role_id = 3;
        $employee->org_id = 28;
        $employee->enable = 1;
        $employee->save();

        DB::statement("ALTER SEQUENCE users_id_seq RESTART 6;");
        //$employee->roles()->attach($role_admin);
    }
}
