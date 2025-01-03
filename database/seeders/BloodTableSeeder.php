<?php

namespace Database\Seeders;

use Faker\Core\Blood;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Type_Blood;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BloodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
     
        DB::table('type__bloods')->delete();

        $bgs = ['O-', 'O+', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-'];

        foreach($bgs as  $bg){
            Type_Blood::create(['Name' => $bg]);
        }
    
    }
}
