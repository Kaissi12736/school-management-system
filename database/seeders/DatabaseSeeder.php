<?php


use Illuminate\Database\Seeder;
use Database\Seeders\BloodTableSeeder;
use Database\Seeders\GenderTableSeeder;
use Database\Seeders\ReligionTableSeeder;
use Database\Seeders\CreateAdminUserSeeder;
use Database\Seeders\NationalitiesTableSeeder;
use Database\Seeders\SpecializationsTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BloodTableSeeder::class);
        $this->call(NationalitiesTableSeeder::class);
        $this->call(ReligionTableSeeder::class);
        $this->call(GenderTableSeeder::class);
        $this->call(SpecializationsTableSeeder::class);
        $this->call(CreateAdminUserSeeder::class);

    }
}