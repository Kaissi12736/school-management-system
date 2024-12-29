<?php 


namespace App\Http\Controllers\Grades;
use App\Models\Grade;
use Illuminate\Http\Request;
use App\Http\Requests\StoreGrades;
use App\Http\Controllers\Controller;


class GradeController extends Controller 
{
 

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $Grades = Grade::all();
    return view('pages.Grades',compact('Grades'));
    
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(StoreGrades $request)
  {
    try {
      $validated = $request->validated();
      $Grade = new Grade();
      /*
      $translations = [
          'en' => $request->Name_en,
          'ar' => $request->Name
      ];
      $Grade->setTranslations('Name', $translations);
      */
      $Grade->Name = ['en' => $request->Name_en, 'ar' => $request->Name];
      $Grade->Notes = $request->Notes;
      $Grade->save();
      
      
      // emotify('success', trans('messages.success'));
      return redirect()->route('Grades.index');
  }

  catch (\Exception $e){
      return redirect()->back()->withErrors(['error' => $e->getMessage()]);
  }

  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(StoreGrades $request)
  {

    try {
 
        $validated = $request->validated();
        $Grades = Grade::findOrFail($request->id);
        $Grades->update([
          $Grades->Name = ['ar' => $request->Name, 'en' => $request->Name_en],
          $Grades->Notes = $request->Notes,
        ]);
        // emotify('success', trans('messages.Update'));
        return redirect()->route('Grades.index');
    }
    catch
    (\Exception $e) {
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy(Request $request)
  {
    try {
      // حذف العنصر
      $grade = Grade::findOrFail($request->id)->delete();

      // إرسال رسالة النجاح إلى الجلسة
      session()->flash('delete_grade', 'تم حذف الصف بنجاح!');

      // إعادة التوجيه
      return redirect()->route('Grades.index');
  } catch (\Exception $e) {
      // في حالة حدوث خطأ
      return redirect()->back()->withErrors(['error' => $e->getMessage()]);
  }


  }
}

