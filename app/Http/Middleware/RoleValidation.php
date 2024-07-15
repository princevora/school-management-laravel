<?php

namespace App\Http\Middleware;

use App\Models\Staff;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

class RoleValidation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $email = session()->get('admin');
        $role = DB::table('schoolstaff')
                    ->select('staff_role')
                    ->where('staff_email','=',$email)
                    ->first();
                                            
        if($role->staff_role !== 'principal'){
            return redirect('admin/dashboard');
        }

        return $next($request);
    }
}
