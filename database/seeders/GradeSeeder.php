<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // حذف جميع البيانات الموجودة مسبقًا
        DB::table('Grades')->delete();

        // تعريف البيانات الجديدة
        $grades = [
            [
                'en' => 'First Primary Stage',
                'ar' => 'المرحلة الأولى ابتدائي'
            ],
            [
                'en' => 'Second Preparatory Stage',
                'ar' => 'المرحلة الثانية اعدادي'
            ],
            [
                'en' => 'Third Secondary Stage',
                'ar' => 'المرحلة الثالثة ثانوي'
            ],
            [
                'en' => 'Third University Stage',
                'ar' => 'المرحلة الثالثة جامعي'
            ],
        ];
        
        // إدخال البيانات في الجدول
        foreach ($grades as $g) {
            Grade::create(['Name' => $g]);
        }

        }
    }
