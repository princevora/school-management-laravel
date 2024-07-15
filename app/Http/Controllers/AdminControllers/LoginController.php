<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Mail\PasswordReset;
use App\Models\Staff;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    public function validateAdmin(Request $request){
        if($request->ajax()){
            $validator = Validator::make($request->all(), [
                'email' => 'email|required',
                'password' => 'required'
            ]);

            if($validator->fails()){
                return response()->json(['error' => 'Please Enter Valid Details'], 422);
            }

            $email = $request->email;
            $password = $request->password;
            $chkStaff = DB::table('schoolstaff')
                            ->where('staff_email','=',$email)
                            ->get();

            if($chkStaff->count() > 0){
                if($password == Hash::check($password,$chkStaff->first()->staff_password)){
                    session()->put('admin',$email);
                    $chkStatus = $chkStaff->first()->permission_login;
                    if($chkStatus === 1){
                        session()->flash('email-login-success');
                    }
                    return response()->json(['message' => 'success'], 200);
                }
                else{
                    return response()->json(['error' => 'The Password is Incorrect..'], 422);
                }
            }
            else{
                return response()->json(['error' => 'No Student Found With This Email'], 422);
            }
        }
    }

    public function findMAil(Request $request){
        if($request->ajax()){
            $email = $request->reset_email;
            $search = Staff::where('staff_email','=',$email)
                            ->get();

            if($search->count() > 0){
                return response()->json(['status','succeed'],200);
            }
            else{
                return response()->json(['warning','No Email Found With '.$email.''],422);
            }
        }
    }

    public function ResetPassword(Request $request){
        if($request->ajax()){
            $email = $request->reset_email;
            $chkStaff = DB::table('schoolstaff')
                            ->where('staff_email','=',$email)
                            ->first();
            if($chkStaff){
                $searchUser = DB::table('password_reset_tokens')
                            ->where('email','=',$email)
                            ->get();

                if($searchUser->count() > 0){
                    return response()->json(['error' => 'You Cannot Request A New Reset Link Unless You Use Last Sent Password Reset Token - Plase Checck Your Email'],422);
                }

                $token = Str::random(65);
                $data = array(
                    'email' => $email,
                    'token' => $token,
                );

                $mail = Mail::to($email)->send(new PasswordReset($data));
                $reset = DB::insert('insert into password_reset_tokens (email,token) values (?, ?)', [$email, $token]);
                return response()->json(['message' => 'succeed']);
            }
            else{
                return response()->json(['error' => 'The Email does not exists'],422);
            }
        }
    }

    public function SearchToken($token, Request $request){
        $userToken = DB::select('select * from password_reset_tokens where email = ? and token = ?', [$request['email'], $token]);
        if(!$userToken){
            return view('admin.errors.token-expired');
        }
        return view('admin.auth.passwords-reset')->with([
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    public function UpdatePassword(Request $request){
        if($request->ajax()){
            $Validator = Validator::make($request->all(), [
                'token' => 'required',
                'email' => 'required|email',
                'password' => 'required|confirmed',
                'password_confirmation' => 'required'
            ]);
            if($Validator->fails()){
                return response()->json(['error' => 'The Password Didnt Matched Or Something Went Wrong'], 422);
            }
            $update = DB::update('update schoolstaff set staff_password = ? where staff_email = ?', [Hash::make($request->password), $request->email]);
            $delete = DB::delete('delete from password_reset_tokens where email = ?', [$request->email]);
            if($delete && $update){
                return response()->json(['status' => 'succeed'], 200);
            }
            else{
                return response()->json(['error' => 'Something Went Wrong'], 422);
            }
        }
    }

    public function logoutStudent(){
        session()->forget('student');
        return redirect('student/login');
    }

    public function LogoutAdmin(){
        session()->forget('admin');
        return redirect('');
    }
}
