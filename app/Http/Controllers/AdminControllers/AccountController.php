<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AccountController extends Controller
{
    public function SaveMessageChanges(Request $request){
        if($request->ajax()){
            $AC_Activity = $request->message_account;
            $AC_Login_Activity = $request->message_login;
            if(!is_numeric($AC_Activity) && !is_numeric($AC_Login_Activity)){
                return response()->json(['error' => 'invalid Data Provided Or Something Went Wrong']);   
            }

            $AC_Update = Staff::where('staff_email','=',session()->get('admin'))
                                ->first();
            $AC_Update->permission_activity = $AC_Activity;
            $AC_Update->permission_login = $AC_Login_Activity;
            $AC_Update->save();

            return response()->json(['activity' =>  $AC_Activity, 'login' => $AC_Login_Activity, 'status' => 'succeed']);
        }   
    }

    public function SettingNotification(){
        $staffdata = Staff::where('staff_email','=',session()->get('admin'))
                    ->first();
        $data = compact('staffdata');
        return view('admin.pages.pages-account-settings-notifications')->with($data);
    }

    public function SettingsProfile(){
        return view('admin.pages.pages-account-settings-profile');
    }

    public function UpdateProfile(Request $request){
        $staff = Staff::where('staff_email','=', session()->get('admin'))
                                ->first();
        if($request->has('staff-avatar')){
            $filename =  'avatar_'.Str::random(35).'.'.$request->file('staff-avatar')->getClientOriginalExtension();
            $staff->avatar = $filename;
            $staff->save();
            $request->file('staff-avatar')->storeAs('public/images', $filename);
        }

        if($request->input('staff-name') == '' ||$request->input('email') == '' ||$request->input('staff-phone') == ''){
            return redirect()->back()->with('error','The Feilds Should Be Valid And Not Be Empty');
        }
        if($request->staff_gender){
            $staff->staff_gender = $request->staff_gender;
        }
        $staff->staff_name = $request->input('staff-name');
        $staff->staff_email = $request->input('email');
        $staff->staff_phone = $request->input('staff-phone');
        $staff->save();

        return redirect()->back()->with(['success' => 'The DATA Has Been Updated']);
    }
}
