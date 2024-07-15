<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Students;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\File;
use App\Models\Standerds;

class AddStudent extends Controller
{
    public function AddStudent(Request $request){
        if($request->ajax()){

            if(empty($request->student_name)){
                return response()->json(['error' => 'Input Feilds Required']);
            }
            $validators = Validator::make($request->all(),[
                'student_name' => 'required',
                'student_email' => 'required|email|unique:students_logs,student_email',
                'student_address' => 'required',
                'student_password' => 'required',
                'student_phone' => 'required',
                'student_standerd' => 'required',
                'student_div' => 'required',
                'student_roll' => 'required',
            ]);

            //Check if the standerd and div exists..
            $chkStd = Standerds::where('standerd','=',$request->student_standerd)
                               ->where('divs','=',$request->student_div)
                               ->get();

            if($chkStd->count() == 0){
                return response()->json(['error' => 'The Standerd Does Not Exists. Make Sure The Standerd Exists..']);
            }

            $errors = $validators->errors();
            if($errors->has('student_email')){
                $emailErrors = $errors->get('student_email');
                return response()->json(['error' => $emailErrors]);
            }

            // if($request->has('student_avatar')){
            //     $filename = 'avatar'.$request->file('student_avatar')->getClientOriginalExtension();
            //     $request->saveAs('/public/uploads', $filename);
            // }

            $student = new Students;
            $student->student_name = $request->student_name;
            $student->roll_no = $request->student_roll;
            $student->student_email = $request->student_email;
            $student->student_address = $request->student_address;
            $student->student_password = Hash::make($request->student_password);
            $student->student_phone = $request->student_phone;
            $student->student_standerd = $request->student_standerd;
            $student->student_div = $request->student_div;
            $student->save();

            return response()->json(['message' => 'success']);
        }
    }

    public function registerStudent(Request $request){
        if($request->ajax()){
            $validators = Validator::make($request->all(),[
                'student_name' => 'required',
                'student_email' => 'required|email|unique:students_logs,student_email',
                'student_password' => 'required'
            ]);

            if($validators->fails()){
                return response()->json(['error' => 'Please Enter Valid Details']);
            }

            $student = new Students;
            $student->student_name = $request->student_name;
            $student->student_email = $request->student_email;
            $student->student_password = Hash::make($request->student_password);
            $student->save();
            session()->put('student',$request->student_email);
            return response()->json(['message' => 'success']);
        }
    }
}
