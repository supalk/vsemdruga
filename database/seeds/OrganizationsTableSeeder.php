<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrganizationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lib_organizations')->delete();
        DB::statement("insert into lib_organizations(id,name,org_type,address,telephone,director,district_id) values(1,'Приют «Щербинка»',1,'г.Москва, ул.Брусилова, вл.32, стр.1-5','','Мисочкин И.А.',8);");
        DB::statement("insert into lib_organizations(id,name,org_type,address,telephone,director,district_id) values(2,'Приют «Некрасовка»',1,'г.Москва, ул.2-я Вольская, вл.17 стр.3','74955144902','Мячиков И.А.',8);");
        DB::statement("insert into lib_organizations(id,name,org_type,address,telephone,director,district_id) values(3,'Приют «Печатники»',1,'г.Москва, Проектируемый проезд №5112, вл.2\1','','Погуляйкин И.А.',8);");
        DB::statement("insert into lib_organizations(id,name,org_type,address,telephone,director,district_id) values(4,'Приют «Солнцево»',1,'г.Москва, ул. Родниковая, вл.26','','Чудакова И.А.',8);");
        DB::statement("insert into lib_organizations(id,name,org_type,address,telephone,director,district_id) values(5,'Приют «GETDOG»',1,'г.Москва, Машкинское шоссе, вл. 4','','Котиков М.Я.',8);");
        DB::statement("insert into lib_organizations(id,name,org_type,address,telephone,director,district_id) values(6,'Приют «Молжаниново»',1,'г.Москва, Проектируемый проезд, 727','','Погуляйка И.А.',8);");
        DB::statement("insert into lib_organizations(id,name,org_type,address,telephone,director,district_id) values(7,'Приют «Искра»',1,'г.Москва, ул.Искры, вл. 23А','','Моськин И.А.',8);");
        DB::statement("insert into lib_organizations(id,name,org_type,address,telephone,director,district_id) values(8,'Приют «Красная сосна»',1,'г.Москва, ул.Красной Сосны, вл. 30, стр.4','','Моськин И.А.',8);");
        DB::statement("insert into lib_organizations(id,name,org_type,address,telephone,director,district_id) values(9,'Приют «Дубовая роща»',1,'г.Москва, проезд Дубовой Рощи, вл.23-25','','Моськин И.А.',8);");
        DB::statement("insert into lib_organizations(id,name,org_type,address,telephone,director,district_id) values(10,'Кожуховский приют',1,'г.Москва, ул. Пехорская 1Б, с.6','','Хвостичкина Н.М',8);");
        DB::statement("insert into lib_organizations(id,name,org_type,address,telephone,director,district_id) values(11,'Приют «Бирюлево»',1,'г.Москва, Востряковский пр-д, вл.10 А','','Черкашин И.А.',8);");
        DB::statement("insert into lib_organizations(id,name,org_type,address,telephone,director,district_id) values(12,'Приют «Зеленоград»',1,'г.Москва, Зеленоград, Фирсановское ш., вл.5А','','Игнатов А.В.',8);");
        DB::statement("insert into lib_organizations(id,name,org_type,address,telephone,director,district_id) values(13,'Приют «Зоорассвет»',1,'г.Москва, ул.Рассветная аллея, влд.10','','Дружинин А.М.',8);");
        DB::statement("insert into lib_organizations(id,name,org_type,address,telephone,director,district_id) values(14,'Префектура ЮЗАО',2,'','','',8);");
        DB::statement("insert into lib_organizations(id,name,org_type,address,telephone,director,district_id) values(15,'ГБУ «Автомобильные дороги ЮЗАО»',3,'','','',8);");
        DB::statement("insert into lib_organizations(id,name,org_type,address,telephone,director,district_id) values(16,'Префектура ЮВАО',2,'','','',8);");
        DB::statement("insert into lib_organizations(id,name,org_type,address,telephone,director,district_id) values(17,'ГБУ «Автомобильные дороги ЮВАО»',3,'','','',8);");
        DB::statement("insert into lib_organizations(id,name,org_type,address,telephone,director,district_id) values(18,'Префектура ЗАО',2,'','','',8);");
        DB::statement("insert into lib_organizations(id,name,org_type,address,telephone,director,district_id) values(19,'ГБУ «Автомобильные дороги ЗАО»',3,'','','',8);");
        DB::statement("insert into lib_organizations(id,name,org_type,address,telephone,director,district_id) values(20,'Префектура САО',2,'','','',8);");
        DB::statement("insert into lib_organizations(id,name,org_type,address,telephone,director,district_id) values(21,'ГБУ «Автомобильные дороги САО»',3,'','','',8);");
        DB::statement("insert into lib_organizations(id,name,org_type,address,telephone,director,district_id) values(22,'Префектура СВАО',2,'','','',8);");
        DB::statement("insert into lib_organizations(id,name,org_type,address,telephone,director,district_id) values(23,'ГБУ «Автомобильные дороги СВАО»',3,'','','',8);");
        DB::statement("insert into lib_organizations(id,name,org_type,address,telephone,director,district_id) values(24,'Префектура ВАО',2,'','','',8);");
        DB::statement("insert into lib_organizations(id,name,org_type,address,telephone,director,district_id) values(25,'ГБУ «Автомобильные дороги ВАО»',3,'','','',8);");
        DB::statement("insert into lib_organizations(id,name,org_type,address,telephone,director,district_id) values(26,'Префектура ЮАО',2,'','','',8);");
        DB::statement("insert into lib_organizations(id,name,org_type,address,telephone,director,district_id) values(27,'ГБУ «Автомобильные дороги ЮАО»',3,'','','',8);");
        DB::statement("insert into lib_organizations(id,name,org_type,address,telephone,director,district_id) values(28,'ДЖКХ города Москвы',4,'','','',8);");
        DB::statement("insert into lib_organizations(id,name,org_type,address,telephone,director,district_id) values(29,'ГБУ «Доринвест»',3,'','','',8);");

        DB::statement("ALTER SEQUENCE lib_organizations_id_seq RESTART 30;");

    }
}
