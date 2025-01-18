<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // بيانات الأقسام
        $sections = [
            [
                'Name_Section' => 'Section A',
                'Status' => 1, // 1 يعني نشط
                'Grade_id' => 1, // المرحلة الابتدائية (مثال)
                'Class_id' => 1, // الصف الأول (مثال)
            ],
            [
                'Name_Section' => 'Section B',
                'Status' => 1,
                'Grade_id' => 1,
                'Class_id' => 2,
            ],
            [
                'Name_Section' => 'Section C',
                'Status' => 0, // 0 يعني غير نشط
                'Grade_id' => 2, // المرحلة الإعدادية
                'Class_id' => 3,
            ],
        ];

        // إدخال البيانات في جدول الأقسام
        foreach ($sections as $section) {
            Section::create($section);
        }
    }
}
