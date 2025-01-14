<?php

namespace App\Providers;

use Livewire\Livewire;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Repository\TeacherRepositoryInterface;
use App\Repository\TeacherRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191); 
       
    }
}
