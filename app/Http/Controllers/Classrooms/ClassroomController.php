<?php 



namespace App\Http\Controllers\Classrooms;
use App\Models\Grade;

use App\Models\Classroom;
use Illuminate\Http\Request;
use App\Http\Requests\StoreGrades;
use Flasher\Prime\FlasherInterface;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;



class ClassroomController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $My_Classes = Classroom::with('Grades')->get();
    $Grades = Grade::all();
    return view('pages.My_Classes.My_Classes',compact('My_Classes','Grades'));
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
  public function store(Request $request)
  {
    $List_Classes = $request->List_Classes;

    try {

        foreach ($List_Classes as $List_Class) {

            $My_Classes = new Classroom();

            $My_Classes->Name_Class = ['en' => $List_Class['Name_class_en'], 'ar' => $List_Class['Name']];

            $My_Classes->Grade_id = $List_Class['Grade_id'];

            $My_Classes->save();

        }

   // إشعار النجاح
   flash()
   ->option('position', app()->getLocale() === 'en' ? 'top-right' : 'top-left')
   ->success(trans('messages.success'));

 return redirect()->route('Classrooms.index');
} catch (\Exception $e) {
 // إشعار الخطأ
 flash()
   ->option('position', app()->getLocale() === 'en' ? 'top-right' : 'top-left')
   ->error(trans('Grades_trans.add_error') . ': ' . $e->getMessage());

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
  public function update($id)
  {
    
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    
  }
  
}

?>