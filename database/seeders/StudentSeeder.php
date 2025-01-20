<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                // الحصول على السنة الحالية
                $currentYear = date("Y");

        // بيانات الطلاب التجريبية
        $students = [
            [
                'name' => json_encode(['en' => 'John Doe', 'ar' => 'جون دو']),
                'email' => 'john@example.com',
                'password' => bcrypt('password123'),
                'gender_id' => 1, // مثال: ذكر
                'nationalitie_id' => 1, // مثال: مصري
                'blood_id' => 1, // مثال: O+
                'Date_Birth' => '2010-05-20',
                'Grade_id' => 1, // مثال: المرحلة الابتدائية
                'Classroom_id' => 1, // مثال: الفصل الأول
                'section_id' => 1, // مثال: القسم الأول
                'parent_id' => 1, // مثال: الأب رقم 1
                'academic_year' => $currentYear, // السنة الدراسية الافتراضية
            ],
            [
                'name' => json_encode(['en' => 'Jane Smith', 'ar' => 'جين سميث']),
                'email' => 'jane@example.com',
                'password' => bcrypt('password456'),
                'gender_id' => 2, // مثال: أنثى
                'nationalitie_id' => 2, // مثال: سعودية
                'blood_id' => 2, // مثال: A+
                'Date_Birth' => '2011-08-15',
                'Grade_id' => 2, // مثال: المرحلة الإعدادية
                'Classroom_id' => 2, // مثال: الفصل الثاني
                'section_id' => 2, // مثال: القسم الثاني
                'parent_id' => 2, // مثال: الأب رقم 2
                'academic_year' => $currentYear, // السنة الدراسية الافتراضية
            ],
        ];

        // إدخال البيانات في جدول الطلاب
        foreach ($students as $student) {
            DB::table('students')->insert($student);
        }
    }
}
