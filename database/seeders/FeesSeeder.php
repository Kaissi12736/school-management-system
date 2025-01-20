<?php

namespace Database\Seeders;

use App\Models\Fee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeesSeeder extends Seeder
{
    public function run()
    {
        // الحصول على السنة الحالية
        $currentYear = date("Y");

        // حذف جميع البيانات الموجودة مسبقًا
        DB::table('fees')->delete();

        // تعريف البيانات
        $fees = [
            [
                'title' => ['en' => 'Tuition Fee', 'ar' => 'رسوم التعليم'],
                'amount' => 1500.50,
                'Grade_id' => 1,
                'Classroom_id' => 1,
                'description' => 'رسوم التعليم للسنة الأولى',
                'year' => $currentYear,
            ],
            [
                'title' => ['en' => 'Lab Fee', 'ar' => 'رسوم المختبر'],
                'amount' => 200.00,
                'Grade_id' => 1,
                'Classroom_id' => 2,
                'description' => 'رسوم المختبر للسنة الأولى',
                'year' => $currentYear,
            ],
        ];
        
        // إدخال البيانات في الجدول
        foreach ($fees as $fee) {
            Fee::create($fee);
        }
    }
}
