<?php


namespace App\Repository;


use App\Models\Grade;
use App\Models\promotion;
use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Flasher\Prime\FlasherInterface;


class StudentPromotionRepository implements StudentPromotionRepositoryInterface
{

    public function index()
    {
        $Grades = Grade::all();
        return view('pages.Students.promotion.index',compact('Grades'));
    }
        public function create()
    {
        $promotions = promotion::all();
        return view('pages.Students.promotion.management',compact('promotions'));
    }

    public function store($request)
    {
        DB::beginTransaction();
    
        try {
            // تعريفات التحقق
            $validated = $request->validate([
                'Grade_id' => 'required|integer|different:Grade_id_new|exists:students',
                'Grade_id_new' => 'required|integer',
                'academic_year_new' => 'required|string|different:academic_year',
                'academic_year' => 'required|integer|exists:students',
                'section_id_new' => 'required|string|different:section_id',
                'Classroom_id' => 'required|integer|exists:students',
                // 'Classroom_id_new' => 'required|integer|exists:students',
                'section_id' => 'required|string|exists:students',
            ]);
    
            // جلب الطلاب من المرحلة المحددة
            $students = Student::where('Grade_id', $request->Grade_id)
                ->where('Classroom_id', $request->Classroom_id)
                ->where('section_id', $request->section_id)
                ->where('academic_year', $request->academic_year)
                ->get();
    
            // التحقق من وجود طلاب
            if ($students->isEmpty()) {
                return redirect()->back()->with('error', __('لاتوجد بيانات في جدول الطلاب'));
            }
    
            // تحديث بيانات الطلاب وإدراج سجلات الترقية
            foreach ($students as $student) {
                // تحديث بيانات الطالب
                $student->update([
                    'Grade_id' => $request->Grade_id_new,
                    'Classroom_id' => $request->Classroom_id_new,
                    'section_id' => $request->section_id_new,
                    'academic_year' => $request->academic_year_new,
                ]);
    
                // إدخال سجلات الترقية
                Promotion::updateOrCreate([
                    'student_id' => $student->id,
                    'from_grade' => $request->Grade_id,
                    'from_Classroom' => $request->Classroom_id,
                    'from_section' => $request->section_id,
                    'to_grade' => $request->Grade_id_new,
                    'to_Classroom' => $request->Classroom_id_new,
                    'to_section' => $request->section_id_new,
                    'academic_year' => $request->academic_year,
                    'academic_year_new' => $request->academic_year_new,
                ]);
            }
    
            DB::commit();
            $this->flashSuccessMessage();
            return redirect()->back();
    
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->withInput() // استرجاع القيم القديمة
                ->withErrors(['error' => $e->getMessage()]); // عرض الأخطاء
        }
    }

    public function destroy($request)
    {
        DB::beginTransaction();

        try {

            // التراجع عن الكل
            if($request->page_id ==1){

             $Promotions = Promotion::all();
             foreach ($Promotions as $Promotion){

                 //التحديث في جدول الطلاب
                 $ids = explode(',',$Promotion->student_id);
                 student::whereIn('id', $ids)
                 ->update([
                 'Grade_id'=>$Promotion->from_grade,
                 'Classroom_id'=>$Promotion->from_Classroom,
                 'section_id'=> $Promotion->from_section,
                 'academic_year'=>$Promotion->academic_year,
               ]);

                 //حذف جدول الترقيات
                 Promotion::query()->delete();

             }
                DB::commit();
              $this->flashDeleteMessage();
                
                return redirect()->back();


            }

            else{

                $Promotion = Promotion::findorfail($request->id);
                student::where('id', $Promotion->student_id)
                    ->update([
                        'Grade_id'=>$Promotion->from_grade,
                        'Classroom_id'=>$Promotion->from_Classroom,
                        'section_id'=> $Promotion->from_section,
                        'academic_year'=>$Promotion->academic_year,
                    ]);


                Promotion::destroy($request->id);
                DB::commit();
                $this->flashDeleteMessage();
                return redirect()->back();
                }

        }

        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



            //____________________________________message flashe ________________________________________//
    
       

            public function flashSuccessMessage()
        {
            flash()
                ->option('position', app()->getLocale() === 'en' ? 'top-right' : 'top-left')
                ->success(trans('messages.success'));
        }
        public function flashDeleteMessage()
        {
            flash()
                ->option('position', app()->getLocale() === 'en' ? 'top-right' : 'top-left')
                ->error(trans('messages.Delete'));
        }

}