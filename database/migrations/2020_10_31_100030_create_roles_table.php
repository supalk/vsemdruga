<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100);
            $table->string('comment',255)->nullable();
            $table->timestamps();
        });
        //DB::statement("ALTER TABLE `roles` comment 'Роли пользователя'");
        DB::statement("comment ON TABLE roles IS 'Роли пользователя'");
        DB::statement("comment ON COLUMN roles.name IS 'Наименование Роли'");
        DB::statement("comment ON COLUMN roles.comment IS 'Комментарий'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
