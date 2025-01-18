<?php

namespace Database\Seeders;

use App\Models\My_Parent;
use Illuminate\Database\Seeder;

class ParentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // بيانات تجريبية للآباء والأمهات
        $parents = [
            [
                'Email' => 'father1@example.com',
                'Password' => bcrypt('password1'),
                'Name_Father' => 'Ahmed Mohamed',
                'National_ID_Father' => '123456789',
                'Passport_ID_Father' => 'P1234567',
                'Phone_Father' => '+201001234567',
                'Job_Father' => 'Engineer',
                'Nationality_Father_id' => 1, // مثال: مصري
                'Blood_Type_Father_id' => 1, // مثال: O+
                'Religion_Father_id' => 1, // مثال: مسلم
                'Address_Father' => '123 Street, Cairo, Egypt',

                'Name_Mother' => 'Amina Ali',
                'National_ID_Mother' => '987654321',
                'Passport_ID_Mother' => 'P7654321',
                'Phone_Mother' => '+201002345678',
                'Job_Mother' => 'Doctor',
                'Nationality_Mother_id' => 1, // مثال: مصرية
                'Blood_Type_Mother_id' => 2, // مثال: A+
                'Religion_Mother_id' => 1, // مثال: مسلمة
                'Address_Mother' => '123 Street, Cairo, Egypt',
            ],
            [
                'Email' => 'father2@example.com',
                'Password' => bcrypt('password2'),
                'Name_Father' => 'Ali Hassan',
                'National_ID_Father' => '223344556',
                'Passport_ID_Father' => 'P2233445',
                'Phone_Father' => '+201112233445',
                'Job_Father' => 'Teacher',
                'Nationality_Father_id' => 2, // مثال: سعودي
                'Blood_Type_Father_id' => 3, // مثال: B+
                'Religion_Father_id' => 2, // مثال: مسيحي
                'Address_Father' => '456 Street, Riyadh, Saudi Arabia',

                'Name_Mother' => 'Fatima Saleh',
                'National_ID_Mother' => '556677889',
                'Passport_ID_Mother' => 'P9988776',
                'Phone_Mother' => '+201223344556',
                'Job_Mother' => 'Nurse',
                'Nationality_Mother_id' => 2, // مثال: سعودية
                'Blood_Type_Mother_id' => 4, // مثال: AB+
                'Religion_Mother_id' => 2, // مثال: مسيحية
                'Address_Mother' => '456 Street, Riyadh, Saudi Arabia',
            ],
        ];

        // إدخال البيانات في جدول الآباء
        foreach ($parents as $parent) {
            My_Parent::create($parent);
        }
    }
}
