<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lib_vets')->delete();
        DB::statement("insert into lib_vets(id,vet_name) values(1,'Врач 1');");
        DB::statement("insert into lib_vets(id,vet_name) values(2,'Врач 2');");
        DB::statement("insert into lib_vets(id,vet_name) values(3,'Врач 3');");
        DB::statement("insert into lib_vets(id,vet_name) values(4,'Врач 4');");
        DB::statement("insert into lib_vets(id,vet_name) values(5,'Врач 5');");
        DB::statement("insert into lib_vets(id,vet_name) values(6,'Врач 6');");
        DB::statement("insert into lib_vets(id,vet_name) values(7,'Врач 7');");
        DB::statement("insert into lib_vets(id,vet_name) values(8,'Врач 8');");
        DB::statement("insert into lib_vets(id,vet_name) values(9,'Врач 9');");
        DB::statement("insert into lib_vets(id,vet_name) values(10,'Врач 10');");
        DB::statement("insert into lib_vets(id,vet_name) values(11,'Врач 11');");
        DB::statement("insert into lib_vets(id,vet_name) values(12,'Врач 12');");
        DB::statement("insert into lib_vets(id,vet_name) values(13,'Врач 13');");
        DB::statement("insert into lib_vets(id,vet_name) values(14,'Врач 14');");
        DB::statement("insert into lib_vets(id,vet_name) values(15,'Врач 15');");
        DB::statement("insert into lib_vets(id,vet_name) values(16,'Врач 16');");
        DB::statement("insert into lib_vets(id,vet_name) values(17,'Врач 17');");
        DB::statement("insert into lib_vets(id,vet_name) values(18,'Врач 18');");
        DB::statement("insert into lib_vets(id,vet_name) values(19,'Врач 19');");
        DB::statement("insert into lib_vets(id,vet_name) values(20,'Врач 20');");
        DB::statement("insert into lib_vets(id,vet_name) values(21,'Врач 21');");
        DB::statement("insert into lib_vets(id,vet_name) values(22,'Врач 22');");
        DB::statement("insert into lib_vets(id,vet_name) values(23,'Врач 23');");
        DB::statement("insert into lib_vets(id,vet_name) values(24,'Врач 24');");
        DB::statement("insert into lib_vets(id,vet_name) values(25,'Врач 25');");
        DB::statement("insert into lib_vets(id,vet_name) values(26,'Врач 26');");
        DB::statement("insert into lib_vets(id,vet_name) values(27,'Врач 27');");

        DB::statement("ALTER SEQUENCE lib_vets_id_seq RESTART 3;");
    }
}
