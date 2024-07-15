<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Mail\loginMail;
use Illuminate\Support\Facades\Mail;

class DashController extends Controller
{
    public function RedirectDash(){
        if(session()->has('email-login-success')){
            $email = session()->get('admin');
            Mail::to($email)->send(new loginMail);
        }

        $transactions = DB::table('payments')
                            ->sum('payment_amount');

        $succeeded = DB::table('payments')
                        ->where('status','=', 1)
                        ->sum('payment_amount');

        $failed = DB::table('payments')
                    ->where('status','=', 0)
                    ->sum('payment_amount');

        $earnings = DB::table('payments')
                        ->where('status','=', 1)
                        ->sum('payment_amount');

        $data = compact('transactions','succeeded','failed','earnings');
        return view('admin.index')->with($data);
    }
}
