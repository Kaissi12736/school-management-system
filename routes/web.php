<?php

use Livewire\Livewire;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Grades\GradeController;
use App\Http\Controllers\Sections\SectionController;
use App\Http\Controllers\Classrooms\ClassroomController;
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


});


//====================breez auth============================================

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';