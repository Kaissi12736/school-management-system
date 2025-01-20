<?php

use Livewire\Livewire;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Grades\GradeController;

use App\Http\Controllers\Students\FeesController;
use App\Http\Controllers\Sections\SectionController;
use App\Http\Controllers\Students\StudentController;
use App\Http\Controllers\Teachers\TeacherController;
use App\Http\Controllers\Students\GraduatedController;
use App\Http\Controllers\Students\PromotionController;
use App\Http\Controllers\Classrooms\ClassroomController;
use App\Http\Controllers\Students\FeesInvoicesController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(['middleware' => ['guest']], function () {
Route::get('/', function () {
    return view('auth.login');
})->name('login');
});


Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
], function () {
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('Grades', GradeController::class);

Route::resource('Classrooms', ClassroomController::class);

Route::post('delete_all', [ClassroomController::class, 'delete_all'])->name('delete_all');

Route::post('Filter_Classes', [ClassroomController::class, 'Filter_Classes'])->name('Filter_Classes');

    //==============================Sections============================

Route::resource('Sections',  SectionController::class);

Route::get('/classes/{id}', [SectionController::class, 'getclasses']);

 //==============================livewire============================
Route::view('add_parent', 'livewire.show_Form')->name('add_parent');
// إضافة تحديث Livewire للغات
Livewire::setUpdateRoute(function ($handle) {
    return Route::post('/livewire/update', $handle);
});

Route::resource('Teachers', TeacherController::class);



  //============================== Students =============================
Route::controller(StudentController::class)->group(function () {
    Route::resource('Students', StudentController::class);
    Route::get('/Get_classrooms/{id}', 'Get_classrooms');
    Route::get('/Get_Sections/{id}', 'Get_Sections');
    Route::resource('Graduated', GraduatedController::class);
    Route::resource('Promotion', PromotionController::class);
    Route::resource('Fees_Invoices', FeesInvoicesController::class);
    Route::delete('/promotion/delete-std-one', [PromotionController::class, 'Delete_std_one'])->name('Promotion.Delete_std_one');
    Route::resource('Fees', FeesController::class);
    Route::post('upload', [StudentController::class,'Upload_attachment'])->name('Upload_attachment');
    Route::get('Download_attachment/{studentsname}/{filename}', [StudentController::class,'Download_attachment'])->name('Download_attachment');
    Route::post('delete',  [StudentController::class, 'Delete_attachment'])->name('Delete_attachment');
});

   
   

   

});













//====================breez auth============================================

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';





























