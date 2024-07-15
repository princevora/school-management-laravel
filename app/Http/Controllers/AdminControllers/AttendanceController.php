<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\attendance;
use App\Models\Standerds;
use Hamcrest\Type\IsNumeric;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    public function getStanderds(){
        $stdDATA = DB::table('standerds')
                    ->select('standerds.id','standerds.standerd','standerds.divs','standerds.limit',DB::raw('COUNT(standerds.id) as totalStudents'))
                    ->join('students_logs', function($join){
                        $join->on('students_logs.student_standerd', '=', 'standerds.standerd');
                        $join->on('students_logs.student_div','=', 'standerds.divs');
                    })
                    ->groupBy('standerds.standerd','standerds.divs','standerds.id','standerds.limit')
                    ->paginate(15);
        // Send data to table..
        $data = compact('stdDATA');
        return view('admin.pages.take-atd')->with($data);
        
    }

    public function TakeATD(Request $request){
        if($request->has('action') && $request->action === 'edit'){
            $title = 'Edit Attendance';
            $heading = 'Select The New Status For The Student To Submit';
            $total = 1;
            $submitURL = url('action/update-atd');
            $stdDATA = DB::table('students_logs')
                        ->select('students_logs.id','students_logs.student_name','attendance.attendance_status')
                        ->join('attendance','students_logs.id','=','attendance.student_id')
                        ->where('student_standerd','=',$request->std)
                        ->where('student_div','=',$request->div)
                        ->where('students_logs.id','=',$request->id)
                        ->where('attendance.created_at','=',$request->atd_date)
                        ->groupBy('students_logs.id','students_logs.student_name','attendance.attendance_status')
                        ->get();
                        
            $data = compact('title','total','stdDATA','heading','submitURL');
            return view('admin.pages.attendance')->with($data);
        }

        //chk if attendance is already taken for the class..
        $date = date('Y-m-d');
        $chkDate = DB::table('students_logs')
                    ->select('students_logs.student_standerd', 'students_logs.student_div')
                    ->join('attendance','attendance.student_id', '=', 'students_logs.id')
                    ->where('attendance.created_at','=',$date)
                    ->where('students_logs.student_standerd','=',$request->std)
                    ->where('students_logs.student_div','=',$request->div)
                    ->get();

        if($chkDate->count() > 0){
            return redirect('attendance/take-atd')->with('error','The Attendance Was already submited..');
        }
        if(empty($request->std) || empty($request->div)){
            return redirect()->back()->with('error','No Standerd Or Div Exists');
        }

        $stdDATA = DB::table('students_logs')
                        ->select('id','student_name')
                        ->where('student_standerd','=',$request->std)
                        ->where('student_div','=',$request->div)
                        ->get();
        $total = $stdDATA->count();
        $data = compact('stdDATA','total');
        return view('admin.pages.attendance')->with($data);
    }

    //Submit Attendance..

    public function SubmitAtd(Request $request){
        if(empty($request->student)){
            return redirect()->back()->with('error','Please Select Students to Continue..');
        }
        
        foreach ($request->student as $key => $value) {
            $apStat = new attendance;
            $apStat->student_id = $key;
            $apStat->attendance_status = ($value == 'absent')? '0' : '1';
            $apStat->save();
        }
        return redirect('attendance/take-atd')->with('success','The Attendance has been submited..');
    }

    //Show Data
    public function AttendanceData(Request $req){
        $Atds = DB::table('attendance')
                    ->select('students_logs.id','students_logs.student_standerd','student_div','students_logs.student_name','attendance.attendance_status','attendance.created_at')
                    ->join('students_logs','attendance.student_id','=','students_logs.id');

        $search = null;
        if($req->has('q')){
            $search = $req->q;
            $Atds->where(function($query) use($search){
                if(is_numeric($search))
                {
                    $query->where('students_logs.id','LIKE','%'.$search.'%')
                        ->orWhere('students_logs.student_standerd','LIKE', '%'.$search.'%');
                }
                if(is_string($search))
                {
                    $query->where('students_logs.student_div','like','%'.$search.'%')
                        ->orWhere('students_logs.student_name','like','%'.$search.'%');
                }
            });
        }
        if($req->has('atdDate')){
            $date = $req->atdDate;
            $Atds->where(function($query) use($date){
                $query->where('attendance.created_at','like','%'.$date.'%');
            });
        }
        //Search Status
        if($req->has('searchStat')){
            $q = $req->searchStat;
            $Atds->where(function($query) use($q){
                $query->where('attendance.attendance_status','like','%'.$q.'%');
            });
        } 
        $Atds = $Atds->paginate(15);
        $data = compact('Atds','search');
        return view('admin.pages.students-attendess')->with($data);
    }

    public function updateATD(Request $request){
        if($request->has('student')){
            foreach ($request->student as $key => $value) {
                $value = ($value == 'absent')? '0' : '1';
                $update = DB::table('attendance')
                            ->where('student_id','=',$key)
                            ->update(['attendance_status' => $value]);
            }
            if($update){
                return redirect('attendance/data-table')->with('success','Student Status Has Been Successfully Updated..');
            }
        }
    }
}
