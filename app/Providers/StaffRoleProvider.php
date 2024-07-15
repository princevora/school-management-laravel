<?php

namespace App\Providers;

use App\Models\Staff;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

class StaffRoleProvider extends ServiceProvider
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
            if(session()->has('admin')){
                $email = session()->get('admin');
                $staffRole = Staff::where('staff_email','=',$email)
                                ->first();
                $roleDATA = compact('staffRole');
                $view->with($roleDATA);
            }
        });
    }
}
