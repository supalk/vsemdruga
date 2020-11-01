<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColoringsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lib_colorings')->delete();
        DB::statement("insert into lib_colorings(id,kind_id,coloring_name) values(1,2,'черный ');");
        DB::statement("insert into lib_colorings(id,kind_id,coloring_name) values(2,2,'белый                                                                  ');");
        DB::statement("insert into lib_colorings(id,kind_id,coloring_name) values(3,2,'лиловый                                                              ');");
        DB::statement("insert into lib_colorings(id,kind_id,coloring_name) values(4,2,'рыжий');");
        DB::statement("insert into lib_colorings(id,kind_id,coloring_name) values(5,2,'кремовый');");
        DB::statement("insert into lib_colorings(id,kind_id,coloring_name) values(6,2,'темно-коричневый');");
        DB::statement("insert into lib_colorings(id,kind_id,coloring_name) values(7,2,'светло-коричневый');");
        DB::statement("insert into lib_colorings(id,kind_id,coloring_name) values(8,2,'молочный');");
        DB::statement("insert into lib_colorings(id,kind_id,coloring_name) values(9,2,'тигровый');");
        DB::statement("insert into lib_colorings(id,kind_id,coloring_name) values(10,2,'триколор (красный/черный/лиловый)');");
        DB::statement("insert into lib_colorings(id,kind_id,coloring_name) values(11,2,'биколор (черный/красный)');");
        DB::statement("insert into lib_colorings(id,kind_id,coloring_name) values(12,2,'лиловый с белым');");
        DB::statement("insert into lib_colorings(id,kind_id,coloring_name) values(13,2,'черно-белый');");
        DB::statement("insert into lib_colorings(id,kind_id,coloring_name) values(14,2,'перец с солью');");
        DB::statement("insert into lib_colorings(id,kind_id,coloring_name) values(15,2,'голубой с подпалом');");
        DB::statement("insert into lib_colorings(id,kind_id,coloring_name) values(16,2,'голубой с пятнами');");
        DB::statement("insert into lib_colorings(id,kind_id,coloring_name) values(17,2,'чепрачный');");
        DB::statement("insert into lib_colorings(id,kind_id,coloring_name) values(18,2,'мраморный');");
        DB::statement("insert into lib_colorings(id,kind_id,coloring_name) values(19,2,'абрикосовый');");
        DB::statement("insert into lib_colorings(id,kind_id,coloring_name) values(20,2,'палевый');");
        DB::statement("insert into lib_colorings(id,kind_id,coloring_name) values(21,2,'волчий');");
        DB::statement("insert into lib_colorings(id,kind_id,coloring_name) values(22,2,'соболиный');");
        DB::statement("insert into lib_colorings(id,kind_id,coloring_name) values(23,2,'муругий');");
        DB::statement("insert into lib_colorings(id,kind_id,coloring_name) values(24,2,'чалый');");
        DB::statement("insert into lib_colorings(id,kind_id,coloring_name) values(25,2,'пегий');");
        DB::statement("insert into lib_colorings(id,kind_id,coloring_name) values(26,1,'черный ');");
        DB::statement("insert into lib_colorings(id,kind_id,coloring_name) values(27,1,'белый');");
        DB::statement("insert into lib_colorings(id,kind_id,coloring_name) values(28,1,'голубой');");
        DB::statement("insert into lib_colorings(id,kind_id,coloring_name) values(29,1,'шоколадный');");
        DB::statement("insert into lib_colorings(id,kind_id,coloring_name) values(30,1,'красный');");
        DB::statement("insert into lib_colorings(id,kind_id,coloring_name) values(31,1,'кремовый');");
        DB::statement("insert into lib_colorings(id,kind_id,coloring_name) values(32,1,'черепаховый');");
        DB::statement("insert into lib_colorings(id,kind_id,coloring_name) values(33,1,'серебристый');");
        DB::statement("insert into lib_colorings(id,kind_id,coloring_name) values(34,1,'пегий');");
        DB::statement("insert into lib_colorings(id,kind_id,coloring_name) values(35,1,'дымчатый');");
        DB::statement("insert into lib_colorings(id,kind_id,coloring_name) values(36,1,'золотой');");
        DB::statement("insert into lib_colorings(id,kind_id,coloring_name) values(37,1,'голубо-кремовый черепаховый');");
        DB::statement("insert into lib_colorings(id,kind_id,coloring_name) values(38,1,'арлекин');");
        DB::statement("insert into lib_colorings(id,kind_id,coloring_name) values(39,1,'биколор');");
        DB::statement("insert into lib_colorings(id,kind_id,coloring_name) values(40,1,'шиншилла');");
        DB::statement("insert into lib_colorings(id,kind_id,coloring_name) values(41,1,'коричневый');");
        DB::statement("insert into lib_colorings(id,kind_id,coloring_name) values(42,1,'светло-коричневый');");
        DB::statement("insert into lib_colorings(id,kind_id,coloring_name) values(43,1,'лиловый');");
        DB::statement("insert into lib_colorings(id,kind_id,coloring_name) values(44,1,'черный с белым ');");
        DB::statement("insert into lib_colorings(id,kind_id,coloring_name) values(45,1,'красный с белым ');");
        DB::statement("insert into lib_colorings(id,kind_id,coloring_name) values(46,1,'голубой с белым ');");
        DB::statement("insert into lib_colorings(id,kind_id,coloring_name) values(47,1,'мраморный ');");
        DB::statement("insert into lib_colorings(id,kind_id,coloring_name) values(48,1,'дымчатый золотистый ');");
        DB::statement("insert into lib_colorings(id,kind_id,coloring_name) values(49,1,'циннамон (корица) ');");
        DB::statement("insert into lib_colorings(id,kind_id,coloring_name) values(50,1,'фавн (бежевый) ');");
        DB::statement("insert into lib_colorings(id,kind_id,coloring_name) values(51,1,'бледно-желтый');");
        DB::statement("insert into lib_colorings(id,kind_id,coloring_name) values(52,1,'тигровый ');");
        DB::statement("insert into lib_colorings(id,kind_id,coloring_name) values(53,1,'черно-красный-белый');");

        DB::statement("ALTER SEQUENCE lib_colorings_id_seq RESTART 54;");
    }
}
