<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Database\Seeder;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // حذف البيانات السابقة
        Classroom::query()->delete();
    
        // تعريف الفصول الدراسية
        $classrooms = [
            'First Primary Stage' => [
                ['en' => 'Class 1A', 'ar' => 'الفصل 1A'],
                ['en' => 'Class 1B', 'ar' => 'الفصل 1B'],
            ],
            'Second Preparatory Stage' => [
                ['en' => 'Class 2A', 'ar' => 'الفصل 2A'],
                ['en' => 'Class 2B', 'ar' => 'الفصل 2B'],
            ],
            'Third Secondary Stage' => [
                ['en' => 'Class 3A', 'ar' => 'الفصل 3A'],
                ['en' => 'Class 3B', 'ar' => 'الفصل 3B'],
            ],
            'Third University Stage' => [
                ['en' => 'Class 4A', 'ar' => 'الفصل 4A'],
                ['en' => 'Class 4B', 'ar' => 'الفصل 4B'],
            ],
        ];
    
        foreach ($classrooms as $gradeName => $classes) {
            $grade = Grade::where('Name->en', $gradeName)->first();
    
            if ($grade) {
                foreach ($classes as $classroom) {
                    Classroom::create([
                        'Name_Class' => $classroom,
                        'Grade_id' => $grade->id,
                    ]);
                }
            }
        }
    }
}    