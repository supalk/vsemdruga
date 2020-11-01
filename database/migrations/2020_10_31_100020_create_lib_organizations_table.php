<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateLibOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lib_organizations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('org_type');
            $table->string('name',255);
            $table->string('address',255);
            $table->string('director',255)->nullable();
            $table->string('telephone',50);
            $table->integer('district_id')->unsigned();
            $table->foreign('district_id')->references('id')->on('lib_districts')->onUpdate('cascade')->onDelete('cascade');
            $table->boolean('enable')->default('1');
            $table->timestamps();
        });
        //DB::statement("ALTER TABLE `lib_organizations` comment 'Справочник организаций'");
        DB::statement("comment ON TABLE lib_organizations IS 'Справочник организаций'");
        DB::statement("comment ON COLUMN lib_organizations.org_type IS 'Тип организации (1-Приют, 2-префектура, 3-эксплуатирующая организация)'");
        DB::statement("comment ON COLUMN lib_organizations.name IS 'Наименование организации'");
        DB::statement("comment ON COLUMN lib_organizations.address IS 'Адрес организации'");
        DB::statement("comment ON COLUMN lib_organizations.telephone IS 'Контактные телефоны'");
        DB::statement("comment ON COLUMN lib_organizations.district_id IS 'Принадлежность к административному округу'");
        DB::statement("comment ON COLUMN lib_organizations.director IS 'Руководитель приюта'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lib_organizations');
    }
}
