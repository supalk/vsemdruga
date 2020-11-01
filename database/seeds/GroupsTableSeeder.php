<?php

use App\Models\Group;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class GroupsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->delete();

        $rec = new Group();
        $rec->id = 1;
        $rec->code = 'pet.add';
        $rec->name = 'Добавление животного';
        $rec->save();

        $rec = new Group();
        $rec->id = 2;
        $rec->code = 'pet.edit';
        $rec->name = 'Изменение карточки животного';
        $rec->save();

        $rec = new Group();
        $rec->id = 3;
        $rec->code = 'lib.org';
        $rec->name = 'Изменение справочника организаций';
        $rec->save();

        $rec = new Group();
        $rec->id = 4;
        $rec->code = 'lib.sub';
        $rec->name = 'Изменение справочника подчинений';
        $rec->save();

        $rec = new Group();
        $rec->id = 5;
        $rec->code = 'lib.distr';
        $rec->name = 'Изменение справочника окгругов';
        $rec->save();

        $rec = new Group();
        $rec->id = 6;
        $rec->code = 'lib.orgtype';
        $rec->name = 'Изменение справочника Типов организаций';
        $rec->save();

        $rec = new Group();
        $rec->id = 7;
        $rec->code = 'lib.kind';
        $rec->name = 'Изменение справочника вида животных';
        $rec->save();

        $rec = new Group();
        $rec->id = 8;
        $rec->code = 'lib.breed';
        $rec->name = 'Изменение справочника пород';
        $rec->save();

        $rec = new Group();
        $rec->id = 9;
        $rec->code = 'lib.color';
        $rec->name = 'Изменение справочника окрасов';
        $rec->save();

        $rec = new Group();
        $rec->id = 10;
        $rec->code = 'lib.ear';
        $rec->name = 'Изменение справочника типов ушей';
        $rec->save();

        $rec = new Group();
        $rec->id = 11;
        $rec->code = 'lib.wool';
        $rec->name = 'Изменение справочника типов шерсти';
        $rec->save();

        $rec = new Group();
        $rec->id = 12;
        $rec->code = 'lib.tail';
        $rec->name = 'Изменение справочника типов хвостов';
        $rec->save();

        $rec = new Group();
        $rec->id = 13;
        $rec->code = 'lib.death';
        $rec->name = 'Изменение справочника причин смерти';
        $rec->save();

        $rec = new Group();
        $rec->id = 14;
        $rec->code = 'lib.leav';
        $rec->name = 'Изменение справочника выбытия из приюта';
        $rec->save();

        $rec = new Group();
        $rec->id = 15;
        $rec->code = 'lib.euth';
        $rec->name = 'Изменение справочника причин эвтаназии';
        $rec->save();

        $rec = new Group();
        $rec->id = 16;
        $rec->code = 'lib.vet';
        $rec->name = 'Изменение справочника ветеренаров';
        $rec->save();

        $rec = new Group();
        $rec->id = 17;
        $rec->code = 'auth.user';
        $rec->name = 'Управление пользователями';
        $rec->save();

        $rec = new Group();
        $rec->id = 18;
        $rec->code = 'auth.role';
        $rec->name = 'Управление ролями';
        $rec->save();

        $rec = new Group();
        $rec->id = 19;
        $rec->code = 'auth.group';
        $rec->name = 'Управление группами ролей';
        $rec->save();

        $rec = new Group();
        $rec->id = 20;
        $rec->code = 'rep.stat';
        $rec->name = 'Формирование статистических отчётов';
        $rec->save();

        $rec = new Group();
        $rec->id = 21;
        $rec->code = 'lib.size';
        $rec->name = 'Справчоник размеров';
        $rec->save();

        DB::statement("ALTER SEQUENCE groups_id_seq RESTART 21;");
    }
}
