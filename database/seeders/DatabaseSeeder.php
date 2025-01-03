<?php


use Illuminate\Database\Seeder;
use Database\Seeders\BloodTableSeeder;
use Database\Seeders\ReligionTableSeeder;
use Database\Seeders\NationalitiesTableSeeder;

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

    }
}