<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Students;
use App\Models\Standerds;
use App\Models\Student\Payments;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StudentsController extends Controller
{
    public function studentData(){
        $studentDATA = Students::paginate(15);
        $data = compact('studentDATA');
        return view('admin.pages.tables-basic')->with($data);
    }

    public function UpdateStudent($id){
       $title = "Update Student";
       $student = Students::where('id', '=', $id)->first();
       if($student->verification_status == 0 || $student->verification_status == 1 || $student->verification_status == 2){
        return redirect('students/data-table')->with('error','The Student Has Not Submited His/Her Details. You Cannot Edit!!');
       }
       elseif(is_null($student)){
            return redirect('students/data-table');
       }
       $data = compact('title', 'student');
       return view('admin.pages.add-student')->with($data);
    }

    public function UpdateEnd(Request $request){
        if($request->ajax()){
            $id = $request->student_id;

            $chkStd = Standerds::where('standerd','=',$request->student_standerd)
                               ->where('divs','=',$request->student_div)
                               ->get();

            if($chkStd->count() == 0){
                return response()->json(['error' => 'The Standerd Does Not Exists. Make Sure The Standerd Exists..']);
            }

            $student = Students::where('id', '=',$id)->first();
            if($student){
                $student->student_name = $request->student_name;
                $student->roll_no = $request->student_roll;
                $student->student_address = $request->student_address;
                $student->student_phone = $request->student_phone;
                $student->student_standerd = $request->student_standerd;
                $student->student_div = $request->student_div;
                $student->save();
                return response()->json(['message' => 'success']);
            }

            return response()->json(['message' => 'error']);
        }
    }

    public function deleteStudent($id){
        $student = Students::where('id', '=', $id)->first();
        if(is_null($student)){
            return redirect()->back()->with('error','The Student Was Not Found');
        }
        if($student->delete()){
            return redirect()->back()->with('success', 'Student Has Been Deleted');
        }
    }

    public function Deletebulk(Request $request){
        if(empty($request->student)){
            return redirect()->back()->with('error', 'Please Select Atleast One Student');
        }
        foreach ($request->student as $id=>$value) {
            $student = Students::where('id', '=', $id)->first();
            if($student){
                $student->delete();
            }
        }
        return redirect('students/data-table')->with('success','The Selected Users Has been deleted');
    }

    public function searchData(Request $request){
        $search = $request['search'];
        if(is_numeric($search)){
            $student = Students::where('id', 'like', '%'.$search.'%')
                                ->orWhere('roll_no', 'like', '%'.$search.'%')
                                ->orWhere('student_standerd', 'like', '%'.$search.'%')
                                ->get();
        }

        else{
            $student = Students::where('student_name', 'like', '%'.$search.'%')
                                ->orWhere('student_address', 'like', '%'.$search.'%')
                                ->orWhere('student_div', 'like','%'.$search.'%')
                                ->get();
        }

        $html = ' <form action="'. url('action/delete').'" method="POST" id="searchData">'
                .csrf_field().'

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Select</th>
                    <th>#</th>
                    <th>Student Name</th>
                    <th>Roll No</th>
                    <th>Phone no</th>
                    <th>Address</th>
                    <th>Standerd</th>
                    <th>Div</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
            <tbody class="table-border-bottom-0">';
            foreach ($student as $Students) {
                $html .= '<tr>
                    <td>
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="student['.$Students->id.']">
                    </div>
                </td>
                    <td>'.$Students->id.'</td>
                    <td>
                    <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                    '.Str::title($Students->student_name).'
                        <li
                        title="'.Str::title($Students->student_name).'"
                        data-toggle="tooltip"
                        class="avatar avatar-xs pull-up"
                        />
                        <img';
                        if($Students->avatar !== null){
                            $html .= ' src="'.asset('/storage/student/'.$Students->avatar.'"');
                        }
                        else{
                            $html .= ' src="https://xsgames.co/randomusers/avatar.php?g=male"';
                        }
                        $html .= 'alt="Avatar" class="rounded-circle" />
                    </li>
                    </ul>
                </td>
                <td>';
                if ($Students->roll_no == 0){
                    $html .= '<span class="badge bg-warning">Unverified</span>';
                }
                else{
                    $html .= $Students->roll_no;
                }
                $html .= '</td>
                        <td>';
                if ($Students->student_phone == 0){
                    $html .= '<span class="badge bg-dark">Unverified</span>';
                }
                else{
                    $html .= $Students->student_phone;
                }
                $html .= '</td>
                        <td>';
                if ($Students->student_address == 0){
                    $html .= '<span class="badge bg-dark">Unverified</span>';
                }
                else{
                    $html .= $Students->student_address;
                }
                $html .= '</td>
                        <td>';
                if ($Students->student_standerd == 0){
                    $html .= $html .= '<span class="badge bg-primary">Unverified</span>';
                }
                else{
                    $html .= $Students->student_standerd;
                }
                $html .= '</td>
                        <td>';
                if ($Students->student_div == 0){
                    $html .= '<span class="badge bg-secondary">Unverified</span>';
                }
                else{
                    $html .= $Students->student_div;
                }
                $html .= '</td>
                        <td>';
                if ($Students->student_div == 0){

                }
                else{
                    $html .= '<a href="'.url('update/'.$Students->id).'"><i class="bx bx-pencil"></i> Edit</a>';
                }
                $html .=
                '</td>
                <td>
                    <a class="dropdown-item" href="'.url('action/delete/'.$Students->id).'"
                        ><i style="color: red" class="bx bx-trash me-1"></i> Delete</a
                    >
                </td>
                </tr>';
            }
             $html .= '</tbody>
                        </table>
                    </div>
                </div>
    </form>';
        $data = ['html' => $html];
        return response()->json($data);
    }

    public function ViewStudent($id){
        if(!is_numeric($id)){
            return redirect('admin/dashboard');
        }

        $student = Students::where('id','=', $id)
                        ->first();

        if(!$student){
            return redirect('admin/dashboard')->with(['error' => 'No Student Found']);
        }
        $payments = Payments::where('student_email','=', $student->student_email)
                            ->get();
        $ttl = Payments::where('student_email','=', $student->student_email)
                        ->where('status','=',1)
                        ->sum('payment_amount');

        $data = compact('student','payments','ttl');
        return view('admin.pages.view-student')->with($data);
    }

    public function paymentData(Request $request){
        if(!str_contains($request->payment_intent,'pi_')){
            return redirect('admin/dashboard')->with(['error' => 'Payment Intent Is Not Valid']);
        }

        $payment = Payments::where('payment_intent','=', $request->payment_intent)
                            ->first();
        if(!$payment){
            return redirect('admin/dashboard')->with(['error' => 'No Such Payment Intent Found']);
        }

        $data = compact('payment');
        return view('admin.pages.view-transaction')->with($data);
    }
}
