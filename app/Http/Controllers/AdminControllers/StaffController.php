<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Staff;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    public function AddStaff(Request $request){
        if($request->ajax()){

            $validators = Validator::make($request->all(),[
                'staff_name' => 'required',
                'staff_email' => 'required|email|unique:schoolstaff,staff_email',
                'staff_password' => 'required',
                'staff_phone' => 'required|numeric',
                'staff_gender' => 'required',
            ]);

            if(!$validators->fails()){
                $staff = new Staff;
                $staff->staff_name = $request->staff_name;
                $staff->staff_email = $request->staff_email;
                $staff->staff_password = Hash::make($request->staff_password);
                $staff->staff_phone = $request->staff_phone;
                $staff->staff_gender = $request->staff_gender;
                $staff->save();
                return response()->json(['success' => 'The Staff Has Been Added Successfully...'], 200);
            }
            return response()->json(['error' => 'Please Check The Input Feilds, The Feilds Are Incorrect.., An Existing Staff Cannot Added Again!'], 422);
        }
    }

    public function deleteStaff(Request $request)
    {
        $staff = Staff::where('id','=', $request->id)->first();
        if(!empty($staff)){
            $staff->delete();
            return redirect()->back()->with(session()->flash('error', 'A Staff Has Been Deleted Successfully'));
        }
    }
    public function StaffDATA(){
        $staffDATA = Staff::paginate(15);
        $data = compact('staffDATA');
        return view('admin.pages.tables-staff')->with($data);
    }
}
