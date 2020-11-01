<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code',20);
            $table->string('name',255);
            $table->timestamps();
        });
        /*DB::statement("ALTER TABLE `groups` comment 'Группы доступа'");*/
        DB::statement("comment ON TABLE groups IS 'Группы доступа'");
        DB::statement("comment ON COLUMN groups.code IS 'Кодовый идентификатор группы'");
        DB::statement("comment ON COLUMN groups.name IS 'Наименование группы'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groups');
    }
}
