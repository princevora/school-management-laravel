<?php

namespace App\Http\Controllers\StudentControllers;

use App\Http\Controllers\Controller;
use App\Models\Standerds;
use App\Models\Students;
use Illuminate\Http\Request;

class StanderdController extends Controller
{
    public function FindStd(Request $request){
        if($request->ajax()){
            $find = Standerds::where('standerd','=', $request->standerd)
                            ->get();
            if($find->count() > 0){
                return response()->json(['status' => 'succeed'], 200);
            }
            else{
                return response('No Standerd Found', 422);
            }
        }
    }

    public function AvailableStanderd(){
        $standerds = Standerds::all();
        $data = compact('standerds');
        return view('student.pages.available-standerd')->with($data);
    }

    public function GetStatus(Request $request){
        if($request->ajax()){
            $student = Students::where('student_email','=', $request->email)
                                    ->first();
            if($student->verification_status === 0){
                $status = 'unverified';
            }
            elseif($student->verification_status === 1){
                $status = 'stage_division';
            }
            elseif ($student->verification_status === 2) {
                $status = 'stage_verification_details';
            }

            return response()->json([
                'status' => $student->verification_status,
                'verificaiton_stage' => $status
            ]);
        }
        else{
            return response()->json(['error' => 'This Method Is Not Supported']);
        }
    }

    public function VerifyStd(Request $request){
        if($request->ajax()){
            if(is_null($request->standerd)){
                return response()->json(['error' => 'Please Choose Valid Standerd'], 422);
            }

            $std = Standerds::where('standerd','=', $request->standerd)->get();
            if(!$std || $std->count() === 0){
                return response()->json(['error' => 'Please Choose Valid Standerd'], 422);
            }

            $update =Students::where('student_email','=', $request->email)
                            ->first();

            $update->student_standerd = $request->standerd;
            $update->verification_status = 1;
            $divs = Standerds::select('divs')
                                ->where('standerd','=', $request->standerd)
                                ->groupby('divs')
                                ->get();
            $html = '<div class="mb-3">
                        <label for="" class="form-label">Select Division</label>
                        <select class="form-select form-select" name="select_div" id="verification_division">
                            <option selected disabled>Select Division</option>';
            foreach ($divs as $div) {
                $html .= '<option value="'.$div->divs.'" name="verification_division">'.$div->divs.'</option>';
            }

            $html .=   '</select>
                    </div>';
            if($update->save()){
                return response()->json([
                    'message' => 'succeed',
                    'form' => $html,
                    'stage' => 'division',
                ], 200);
            }
            else{
                return response()->json(['error' => 'Something Went Wrong']);
            }
        }
    }

    public function VerifyDiv(Request $request){
        if($request->ajax()){
            if(is_null($request->division)){
                return response()->json(['error' => 'Please Choose Valid Division'], 422);
            }
            else{
                $student = Students::where('student_email','=', $request->email)
                                    ->first();
                $student->student_div = $request->division;
                $student->verification_status = 2;
                if($student->save()){
                    return response()->json(['message' => 'succeed'], 200);
                }
                else{
                    return response()->json(['error' => 'Something Went Wrong'], 422);
                }
            }
        }
        else{
            return response()->json(['message' => 'The Method Is Not Supported'], 422);
        }
    }
}
