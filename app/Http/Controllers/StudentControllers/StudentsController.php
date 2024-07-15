<?php

namespace App\Http\Controllers\StudentControllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\Standerds;
use App\Models\Students;
use App\Models\Tasks;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class StudentsController extends Controller
{
    public function ValidateStudent(Request $request){
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
            $chkStudent = DB::table('students_logs')
                            ->where('student_email','=',$email)
                            ->get();

            if($chkStudent->count() > 0){
                if($password == Hash::check($password,$chkStudent->first()->student_password)){
                    session()->put('student',$email);
                    //Response
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

    public function StudentData(){
        $email = session()->get('student');
        $student = Students::where('student_email','=', $email)
                        ->first();

        $payments = DB::table('payments')
                            ->where('student_email','=', $email)
                            ->where('status','=',1)
                            ->sum('payment_amount');

        $task = Tasks::where('std','=', $student->student_standerd)
                    ->where('div','=', $student->student_div)
                    ->where('created_at', '>', now()->subDays(1)->endOfDay())
                    ->first();
        // Attendance data For last 6 days
        // $users = DB::table("users")
        //             ->select('id')
        //             ->where('accounttype', 'standard')
        //             ->where('created_at', '>', now()->subDays(30)->endOfDay())
        //             ->all();
        //Compact The Data..

        $data = compact('student','payments','task');
        if($student->verification_status == null || $student->verification_status == 0){
            return view('student.auth.student-verification')->with($data);
        }
        if($student->verification_status === 1 || $student->verification_status === 2 || $student->verification_status === 0){
            $divs = Standerds::select('divs')
                            ->where('standerd','=', $student->student_standerd)
                            ->groupby('divs')
                            ->get();
            $data = compact('student', 'divs');
            return view('student.auth.student-verification')->with($data);
        }
        return view('student.index')->with($data);
    }

    public function VerifyDetails(Request $request){
        if($request->ajax()){

            //Validate details

            $validator = Validator::make($request->all(), [
                'student_roll' => 'required|numeric',
                'student_address' => 'required',
                'student_phone' => 'required|numeric'
            ]);

            //Send Error IF The validation fails
            if($validator->fails()){
                return response()->json(['error' => 'Please Enter valid details'], 422);
            }

            $roll = $request->student_roll;
            $address = $request->student_address;
            $phone = $request->student_phone;

            $student = Students::where('student_email','=', $request->email)
                                ->first();
            //Save Details
            $student->roll_no = $roll;
            $student->student_phone = $phone;
            $student->student_address = $address;
            $student->verification_status = 3;

            //Conditions
            if($student->save()){
                return response()->json(['message' => 'succeed'], 200);
            }
            else{
                return response()->json(['error' => 'Something went wrong'], 422);
            }
        }
        else{
            return response()->json(['message' => 'The Method Is Not Supported'], 422);
        }
    }

    public function studentProfile(){
        $email = session()->get('student');
        $student = Students::where('student_email','=', $email)
                            ->first();
        $data = compact('student');
        return view('student.pages.student-profile')->with($data);
    }

    public function UpdateStudent(Request $request){
        $student = Students::where('student_email','=', session()->get('student'))
                                ->first();
        if($request->has('student_avatar')){
            $filename =  'avatar_'.Str::random(35).'.'.$request->file('student_avatar')->getClientOriginalExtension();
            $student->avatar = $filename;
            $student->save();
            $request->file('student_avatar')->storeAs('public/student', $filename);
        }

        if($request->input('email') == '' ||$request->input('student_phone') == ''){
            return redirect()->back()->with('error','The Feilds Cannot Be Empty');
        }

        $student->student_email = $request->input('email');
        $student->student_phone = $request->input('student_phone');
        $student->save();
        return redirect()->back()->with(['success' => 'The DATA Has Been Updated']);
    }

    public function StudentLogOut(){
        session()->forget('student');
        return redirect('');
    }
}
