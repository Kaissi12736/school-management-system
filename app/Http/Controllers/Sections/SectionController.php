<?php
namespace App\Http\Controllers\Sections;
use App\Models\Grade;
use App\Models\Classroom;
use Illuminate\Http\Request;
use App\Http\Requests\StoreGrades;
use Flasher\Prime\FlasherInterface;
use App\Http\Controllers\Controller;

use App\Http\Requests\StoreClassroom;
use Illuminate\Support\Facades\Session;


use App\Models\Section;

use App\Http\Requests\StoreSections;




class SectionController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {

    $Grades = Grade::with(['Sections' => function ($query) {
      $query->whereHas('My_classs'); // جلب فقط الأقسام المرتبطة
  }])->get();

  $list_Grades = Grade::all();

  return view('pages.Sections.Sections', compact('Grades', 'list_Grades'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(StoreSections $request)
  {

    try {

      $validated = $request->validated();
      $Sections = new Section();

      $Sections->Name_Section = ['ar' => $request->Name_Section_Ar, 'en' => $request->Name_Section_En];
      $Sections->Grade_id = $request->Grade_id;
      $Sections->Class_id = $request->Class_id;
      $Sections->Status = 1;
      $Sections->save();
      flash()
      ->option('position', app()->getLocale() === 'en' ? 'top-right' : 'top-left')
      ->success(trans('messages.success'));
      return redirect()->route('Sections.index');
   
  }

  catch (\Exception $e){
      return redirect()->back()->withErrors(['error' => $e->getMessage()]);
  }

  }


  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(StoreSections $request)
  {

    try {
      $validated = $request->validated();
      $Sections = Section::findOrFail($request->id);

      $Sections->Name_Section = ['ar' => $request->Name_Section_Ar, 'en' => $request->Name_Section_En];
      $Sections->Grade_id = $request->Grade_id;
      $Sections->Class_id = $request->Class_id;

      if(isset($request->Status)) {
        $Sections->Status = 1;
      } else {
        $Sections->Status = 2;
      }

      $Sections->save();
      flash()
    ->option('position', app()->getLocale() === 'en' ? 'top-right' : 'top-left')
    ->success(trans('messages.Update'));
    return redirect()->route('Sections.index');
  

      return redirect()->route('Sections.index');
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
  public function destroy(request $request)
  {

    Section::findOrFail($request->id)->delete();
    flash()
    ->option('position', app()->getLocale() === 'en' ? 'top-right' : 'top-left')
    ->success(trans('messages.Delete'));
    return redirect()->route('Sections.index');

  }

  public function getclasses($id)
    {
        $list_classes = Classroom::where("Grade_id", $id)->pluck("Name_Class", "id");

        return $list_classes;
    }

}

?>