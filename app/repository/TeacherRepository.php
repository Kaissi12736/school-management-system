<?php

namespace App\Repository;
use Exception;
use App\Models\Gender;
use App\Models\Teacher;
use App\Models\Specialization;
use Illuminate\Support\Facades\Hash;
use Flasher\Prime\FlasherInterface;


class TeacherRepository implements TeacherRepositoryInterface{

  public function getAllTeachers(){
      
  }
  public function Getspecialization(){
    return Specialization::all();
  }
  public function GetGender(){
    return Gender::all();
 }
 public function StoreTeachers($request){

  try {
          $Teachers = new Teacher();
          $Teachers->Email = $request->Email;
          $Teachers->Password =  Hash::make($request->Password);
          $Teachers->Name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
          $Teachers->Specialization_id = $request->Specialization_id;
          $Teachers->Gender_id = $request->Gender_id;
          $Teachers->Joining_Date = $request->Joining_Date;
          $Teachers->Address = $request->Address;
          $Teachers->save();
          flash()
          ->option('position', app()->getLocale() === 'en' ? 'top-right' : 'top-left')
          ->success(trans('messages.success'));         
           return redirect()->route('Teachers.create');
      }
      catch (Exception $e) {
          return redirect()->back()->with(['error' => $e->getMessage()]);
      }

  }


  public function editTeachers($id)
  {
      try {
          return Teacher::findOrFail($id);
      } catch (Exception $e) {
          return redirect()->back()->withErrors(['Teacher not found']);
      }
  }
  
  public function UpdateTeachers($request)
  {
      try {
          $Teachers = Teacher::findOrFail($request->id);
          $Teachers->Email = $request->Email;
          $Teachers->Password =  Hash::make($request->Password);
          $Teachers->Name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
          $Teachers->Specialization_id = $request->Specialization_id;
          $Teachers->Gender_id = $request->Gender_id;
          $Teachers->Joining_Date = $request->Joining_Date;
          $Teachers->Address = $request->Address;
          $Teachers->save();
          
          flash()
          ->option('position', app()->getLocale() === 'en' ? 'top-right' : 'top-left')
          ->success(trans('messages.Update'));         
          return redirect()->route('Teachers.index');
      }
      catch (Exception $e) {
          return redirect()->back()->with(['error' => $e->getMessage()]);
      }
  }


  public function DeleteTeachers($request)
  {
      Teacher::findOrFail($request->id)->delete();
      flash()
      ->option('position', app()->getLocale() === 'en' ? 'top-right' : 'top-left')
      ->error(trans('messages.Delete'));        
      return redirect()->route('Teachers.index');

     
  }
}