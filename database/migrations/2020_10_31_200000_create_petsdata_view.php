<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreatePetsdataView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        DB::statement("CREATE OR REPLACE view petsdata AS
            SELECT pets.*,
	            ps.state_name,
	            lorgt.type_name,
	            lorg.name as org_name,
	            lorg.address as org_address,
	            lorg.telephone as org_telephone,
                lorg.district_id as org_district_id,
                lorg.enable as org_enable,
                lsizes.size_name,
                lk.kind_name,
                le.eartype_name,
                lt.tailtype_name,
                lb.breed_name,
                lc.coloring_name,
                lw.wooltype_name,
                lrd.death_name,
                lrl.leaving_name,
                lre.euthanasia_name,
                vet.vet_name
            from pets
            left JOIN pet_states ps ON ps.id=pets.state_id
            left JOIN lib_organizations lorg ON lorg.id=pets.shelter_id
            left JOIN lib_orgtypes lorgt ON lorgt.id=lorg.org_type
            left JOIN lib_sizes lsizes ON lsizes.id=pets.size_id
            left JOIN lib_kinds lk ON lk.id=pets.kind_id
            left JOIN lib_eartypes le ON le.id=pets.eartype_id
            left JOIN lib_tailtypes lt ON lt.id=pets.tailtype_id
            left JOIN lib_breeds lb ON lb.id=pets.breed_id
            left JOIN lib_colorings lc ON lc.id=pets.coloring_id
            left JOIN lib_wooltypes lw ON lw.id=pets.wooltype_id
            left JOIN lib_reason_deaths lrd ON lrd.id=pets.reason_death_id
            left JOIN lib_reason_leavings lrl ON lrl.id=pets.reason_leaving_id
            left JOIN lib_reason_euthanasias lre ON lre.id=pets.reason_euthanasia_id
            left JOIN lib_vets vet ON vet.id=pets.vet_id");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists('petsdata');
    }
}
