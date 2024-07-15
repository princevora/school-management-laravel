<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Standerds;
use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StanderdController extends Controller
{
    public function Standerds(){
        $stdDATA = DB::table('standerds')
                      ->select('standerds.id','standerds.standerd','standerds.divs','standerds.limit')
                      ->get();

        // $count = DB::table('students_logs')
        //             ->selectRaw('count(students_logs.student_standerd) as total')
        //             ->join('standerds',function($join) {
        //                   $join->on('standerds.standerd','=','students_logs.student_standerd');
        //                   $join->on('standerds.divs','=','students_logs.student_div');
        //             })
        //             ->get();

        $data = compact('stdDATA');
        return view('admin.pages.tables-standerds')->with($data);
    }
    public function AddStanderd(Request $request){
        if($request->ajax()){
            $validator = Validator::make($request->all(), [
                'standerd_limit' => 'required|numeric'
            ]);

            if($validator->fails()){
                return response()->json(['message' => 'The Input Feilds Are Invalid Or Something went wrong'], 422);
            }
            //Vars
            $standerd = $request->standerd;
            $standerd_div = $request->standerd_div;
            $limit = $request->standerd_limit;

            //check if the standerd exists or not 
            $std = Standerds::where('standerd','=', $standerd)
                            ->where('divs','=', $standerd_div)
                            ->get();
                            
            if($std->count() > 0){
                return response()->json(['message' => 'The Standerd Already Exists'], 409);
            }

            //Check Students If the Standerd was deleted in past..
            $students = DB::table('students_logs')
                            ->where('student_standerd','=',$standerd)
                            ->where('student_div','=',$standerd_div)
                            ->where('verification_status','=',99)
                            ->update([
                                'verification_status' => 3
                            ]);
            //Add Standerd
            $AddStd = new Standerds;
            $AddStd->standerd = $standerd;
            $AddStd->divs = $standerd_div;
            $AddStd->limit = $limit;
            $AddStd->save();

            return response()->json(['message' => 'The Standerd Has Been Added'], 200);
        }
    }

    public function DeleteStd($id){
        $standerd = Standerds::where('id','=',$id)->first();
        if(!$standerd){
            return redirect('standerds/data-table')->with(['error' => 'No Standerd Found']);
        }

        $students = DB::table('students_logs')
                        ->where('student_standerd','=', $standerd->standerd)
                        ->where('student_div','=',$standerd->divs)
                        ->where('verification_status','=',3)
                        ->update([
                            'verification_status' => 99
                        ]);
        $standerd->delete();
        return redirect()->back()->with('success','The Standerd Has Been Deleted Successfully');
    }

    public function DeleteBulk(Request $request){
        if(empty($request->standerd)){
            return redirect()->back()->with('error', 'Please Select Atleast One Standerd'); 
        }
        foreach ($request->standerd as $id=>$value) {
            $student = Standerds::where('id', '=', $id);
            if($student){
                $student->delete();
            }
        }
        return redirect()->back()->with('success','The Selected Standerds Has been deleted');
    }

    public function FindStd(Request $request){
        if($request->ajax()){
            $std = $request->standerd;
            $find = Standerds::where('standerd','=', $std)
                            ->get();
            if($find->count() === 0){
                return response()->json(['error' => 'No standerd found'], 422);
            }
            $html = '<div class="col-12">
                        <label for="selectDiv" class="form-label">Select Division</label>
                        <select class="form-select" id="selectDiv" aria-label="Default select example" name="student_div">
                            <option selected disabled>Select Division</option>';
                        foreach ($find as $key => $div) {
                            $html .= '<option value="'.$div->divs.'">'.$div->divs.'</option>';
                        }
            $html .=    '</select>
                    </div>';
            return response()->json(['divisions' => $html]);
        }
        else{
            return response()->json(['message' => 'Method Not Supported']);
        }
    }

    public function AllStudent(Request $request){
        if($request->ajax()){
            $id = $request->standerd_id;
            if(!is_numeric($id)){
                return response()->json(['error' => 'Please Provide a valid Standerd Id'], 422);
            }

            $standerd = Standerds::where('id','=',$id)
                                    ->first();
            if(!$standerd){
                return response()->json(['error' => 'No Standerd Found'], 422);
            }
            else{
                $data = Students::Where('student_standerd','=',$standerd->standerd)
                                ->where('student_div','=',$standerd->divs)
                                ->get();
                if($data && $data->count() > 0){
                   $html = '
                   <h5>Total Students '.$data->count().'</h5>
                   <div class="table-responsive text-nowrap">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Student Name</th>
                                <th>Student Roll</th>
                                <th>View Student</th>
                            </tr>
                            </thead>
                        <tbody class="table-border-bottom-0">';
                            foreach ($data as $student) {  
                                $html .= '<tr>
                                <td>';
                                $html .= $student->student_name;
                                $html .= '</td>

                                <td>';
                                $html .= $student->roll_no;
                                $html .= '</td>';

                                $html .= '<td>
                                            <a href="'.url('admin/students/view/'.$student->id.'').'" data-toggle="tooltip" title="View : '.Str::title($student->student_name).'">
                                            <i class="fa-regular fa-eye" style="color: red"></i>
                                            </a>
                                        </td>';
                                $html .= '</tr>';
                            }
                            $html .= '</tbody>
                            </table>
                        </div>
                    </div>';
                    return response()->json([
                        'students' => $html
                    ]);
                }
                else{
                    return response()->json([
                        'message' => '0',
                        'status' => 'failure'
                    ], 422);
                }
            }
        }
        else{
            return response()->json(['message' => 'Method not supported']);
        }
    }
}
