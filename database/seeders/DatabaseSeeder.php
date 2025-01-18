<?php


use Illuminate\Database\Seeder;
use Database\Seeders\GradeSeeder;
use Database\Seeders\ParentSeeder;
use Database\Seeders\SectionSeeder;
use Database\Seeders\StudentSeeder;
use Database\Seeders\TeacherSeeder;
use Database\Seeders\ClassroomSeeder;
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
        $this->call(BloodTableSeeder::class); // فصائل الدم
        $this->call(NationalitiesTableSeeder::class); // الجنسيات
        $this->call(ReligionTableSeeder::class); // الأديان
        $this->call(GenderTableSeeder::class); // الجنس
        $this->call(SpecializationsTableSeeder::class); // التخصصات
    
        $this->call(GradeSeeder::class); // المراحل الدراسية
        $this->call(ClassroomSeeder::class); // الصفوف الدراسية
        $this->call(SectionSeeder::class); // الأقسام الدراسية
    
        $this->call(ParentSeeder::class); // الآباء
        $this->call(TeacherSeeder::class); // المدرسون
        $this->call(StudentSeeder::class); // الطلاب
    
        $this->call(CreateAdminUserSeeder::class); // المستخدم الإداري
    }
    
}