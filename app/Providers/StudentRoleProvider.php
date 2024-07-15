<?php

namespace App\Providers;

use App\Models\Students;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class StudentRoleProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*', function($view){
           if(session()->has('student')){
                $email = session()->get('student');
                $studentData = Students::where('student_email','=', $email)
                                        ->first();
                $roleData = compact('studentData');
                $view->with($roleData);
           }
        });
    }
}
