<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // بيانات تجريبية للمدرسين
        $teachers = [
            [
                'Email' => 'teacher1@example.com',
                'Password' => bcrypt('password1'),
                'Name' => json_encode(['en' => 'Teacher One', 'ar' => 'المعلم الاول']),
                'Specialization_id' => 1, // مثال: تخصص الرياضيات
                'Gender_id' => 1, // مثال: ذكر
                'Joining_Date' => '2020-09-01',
                'Address' => '123 Main Street, Cairo, Egypt',
            ],
            [
                'Email' => 'teacher2@example.com',
                'Password' => bcrypt('password2'),
                'Name' => json_encode(['en' => 'Teacher Two', 'ar' => 'المعلم الثاني']),
                'Specialization_id' => 2, // مثال: تخصص الفيزياء
                'Gender_id' => 2, // مثال: أنثى
                'Joining_Date' => '2018-08-15',
                'Address' => '456 Elm Street, Alexandria, Egypt',
            ],
        ];

        // إدخال البيانات في جدول المدرسين
        foreach ($teachers as $teacher) {
            DB::table('teachers')->insert($teacher);
        }
    }
}
