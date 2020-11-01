<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(OrgTypesTableSeeder::class);
        $this->call(DistrictsTableSeeder::class);
        $this->call(OrganizationsTableSeeder::class);
        $this->call(SubordinationsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(GroupsTableSeeder::class);
        $this->call(RoleGroupsTableSeeder::class);
        $this->call(UsersTableSeeder::class);

        $this->call(KindsTableSeeder::class);
        $this->call(BreedsTableSeeder::class);
        $this->call(ColoringsTableSeeder::class);
        $this->call(WoolsTableSeeder::class);
        $this->call(EarTypesTableSeeder::class);
        $this->call(TailTypesTableSeeder::class);
        $this->call(ReasonDethsTableSeeder::class);
        $this->call(ReasonLeavingsTableSeeder::class);
        $this->call(EuthanasiasTableSeeder::class);
        $this->call(VetsTableSeeder::class);
        $this->call(SizesTableSeeder::class);
        $this->call(StatesTableSeeder::class);
        $this->call(PetsTableSeeder::class);
        $this->call(Pet_vaccinationsTableSeeder::class);
        $this->call(Pet_treatmentsTableSeeder::class);
        $this->call(Pet_inspectionsTableSeeder::class);

    }
}
