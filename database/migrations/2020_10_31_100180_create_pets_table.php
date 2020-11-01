<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('state_id')->unsigned();
            $table->foreign('state_id')->references('id')->on('pet_states')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('shelter_id')->unsigned();
            $table->foreign('shelter_id')->references('id')->on('lib_organizations')->onUpdate('cascade')->onDelete('cascade');

            $table->string('num_aviary',50)->nullable();
            $table->string('num_card',50)->nullable();
            $table->string('ind_label',255)->nullable();
            $table->string('nickname',30)->nullable();
            $table->date('year_birth')->nullable();
            $table->decimal('weight',5,1);
            $table->integer('size_id')->unsigned();
            $table->foreign('size_id')->references('id')->on('lib_sizes')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('kind_id')->unsigned();
            $table->foreign('kind_id')->references('id')->on('lib_kinds')->onUpdate('cascade')->onDelete('cascade');
            $table->boolean('male')->nullable();
            $table->integer('eartype_id')->unsigned();
            $table->foreign('eartype_id')->references('id')->on('lib_eartypes')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('tailtype_id')->unsigned();
            $table->foreign('tailtype_id')->references('id')->on('lib_tailtypes')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('breed_id')->unsigned();
            $table->foreign('breed_id')->references('id')->on('lib_breeds')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('coloring_id')->unsigned();
            $table->foreign('coloring_id')->references('id')->on('lib_colorings')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('wooltype_id')->unsigned();
            $table->foreign('wooltype_id')->references('id')->on('lib_wooltypes')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('vet_id')->nullable()->unsigned();
            $table->foreign('vet_id')->references('id')->on('lib_vets')->onUpdate('cascade')->onDelete('cascade');
            $table->string('specials',500)->nullable();
            $table->string('temper',255)->nullable();
            $table->string('mark_sterilization',255)->nullable();
            $table->text('photo')->nullable();
            $table->string('note_for_social')->nullable();
            $table->integer('reason_death_id')->unsigned()->nullable();
            $table->foreign('reason_death_id')->references('id')->on('lib_reason_deaths')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('reason_euthanasia_id')->unsigned()->nullable();
            $table->foreign('reason_euthanasia_id')->references('id')->on('lib_reason_euthanasias')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('care_worker',255)->nullable();

            //Движение
            //Прибытие
            $table->date('in_date');
            $table->string('in_akt',50);
            //Выбытие
            $table->date('out_date')->nullable();
            $table->integer('reason_leaving_id')->unsigned()->nullable();
            $table->foreign('reason_leaving_id')->references('id')->on('lib_reason_leavings')->onUpdate('cascade')->onDelete('cascade');
            $table->string('out_akt',100)->nullable();
            //Данные об отлове
            $table->string('catch_order',100)->nullable();
            $table->date('catch_date_order')->nullable();
            $table->string('catch_akt',50)->nullable();
            $table->string('catch_address',255)->nullable();
            //Сведения о владельцах
            $table->string('own_entity_name',255)->nullable();
            $table->string('own_fio',255)->nullable();
            $table->string('own_passport_num',10)->nullable();
            $table->string('own_passport_issued',255)->nullable();
            $table->date('own_passport_date',255)->nullable();
            $table->string('own_address',255)->nullable();
            $table->string('own_telephone',100)->nullable();
            $table->string('own_guardian_name',255)->nullable();
            $table->string('own_entity_address',255)->nullable();
            $table->string('own_entity_telephon',100)->nullable();



            $table->timestamps();
        });
        //DB::statement("comment ON TABLE pets IS ''");
        DB::statement("comment ON COLUMN pets.state_id IS 'Состояние животного'");
        DB::statement("comment ON COLUMN pets.shelter_id IS 'Id приюта'");
        DB::statement("comment ON COLUMN pets.num_aviary IS 'Номер вольера'");
        DB::statement("comment ON COLUMN pets.num_card IS 'Номер карточки'");
        DB::statement("comment ON COLUMN pets.ind_label IS 'Идентификационная метка'");
        DB::statement("comment ON COLUMN pets.nickname IS 'Кличка'");
        DB::statement("comment ON COLUMN pets.year_birth IS 'Год.месяц рождения'");
        DB::statement("comment ON COLUMN pets.weight IS 'Вес, кг.гр'");
        DB::statement("comment ON COLUMN pets.size_id IS 'Размер животного'");
        DB::statement("comment ON COLUMN pets.kind_id IS 'Вид животного'");
        DB::statement("comment ON COLUMN pets.male IS 'Пол животного, true=мужской,false=женский'");
        DB::statement("comment ON COLUMN pets.eartype_id IS 'Тип ушей животного'");
        DB::statement("comment ON COLUMN pets.tailtype_id IS 'Тип хвоста'");
        DB::statement("comment ON COLUMN pets.breed_id IS 'Порода животного'");
        DB::statement("comment ON COLUMN pets.coloring_id IS 'Окрас животного'");
        DB::statement("comment ON COLUMN pets.wooltype_id IS 'Тип шерсти животного'");
        DB::statement("comment ON COLUMN pets.specials IS 'Особые приметы'");
        DB::statement("comment ON COLUMN pets.temper IS 'Характер'");
        DB::statement("comment ON COLUMN pets.note_for_social IS 'Фраза для социализации'");
        DB::statement("comment ON COLUMN pets.photo IS 'Фотографии'");
        DB::statement("comment ON COLUMN pets.reason_death_id IS 'Причина смерти'");
        DB::statement("comment ON COLUMN pets.reason_leaving_id IS 'Причина выбытия'");
        DB::statement("comment ON COLUMN pets.reason_euthanasia_id IS 'Причина эвтаназии'");
        DB::statement("comment ON COLUMN pets.user_id IS 'Пользователь создавший карточку'");
        DB::statement("comment ON COLUMN pets.care_worker IS 'Сотрудник по уходу'");
        DB::statement("comment ON COLUMN pets.in_date IS 'Дата поступления'");
        DB::statement("comment ON COLUMN pets.in_akt IS 'Номер Акта поступления'");
        DB::statement("comment ON COLUMN pets.out_date IS 'Дата выбытия'");
        DB::statement("comment ON COLUMN pets.out_akt IS 'Номер Акта(договора) выбытия'");
        DB::statement("comment ON COLUMN pets.mark_sterilization IS 'Пометка о стерилизации'");

        DB::statement("comment ON COLUMN pets.catch_order IS 'Номер заказ-наряд'");
        DB::statement("comment ON COLUMN pets.catch_date_order IS 'Дата заказ-наряд'");
        DB::statement("comment ON COLUMN pets.catch_akt IS 'Акт отлова'");
        DB::statement("comment ON COLUMN pets.catch_address IS 'Адрес отлова'");

        DB::statement("comment ON COLUMN pets.own_telephone IS 'Телефон владельца'");
        DB::statement("comment ON COLUMN pets.own_address IS 'Адрес проживания владельца'");
        DB::statement("comment ON COLUMN pets.own_fio IS 'ФИО владельца'");
        DB::statement("comment ON COLUMN pets.own_entity_name IS 'Наименование Юридичсекой организации владельца'");


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pets');
    }
}
