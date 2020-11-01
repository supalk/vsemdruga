<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_name',255);
            $table->string('email',50)->unique();
            $table->string('password',100);
            $table->string('telephon',12)->nullable();
            $table->integer('role_id')->unsigned();
            $table->foreign('role_id')->references('id')->on('roles')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('org_id')->unsigned();
            $table->foreign('org_id')->references('id')->on('lib_organizations')->onUpdate('cascade')->onDelete('cascade');
            $table->boolean('enable')->default('1');
            $table->rememberToken();
            $table->timestamps();
        });
        /*DB::statement("ALTER TABLE `users` comment 'Пользователи'");*/
        DB::statement("comment ON TABLE users IS 'Пользователи'");
        DB::statement("comment ON COLUMN users.role_id IS 'Роль пользователя'");
        DB::statement("comment ON COLUMN users.org_id IS 'Принадлежность к организации'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
