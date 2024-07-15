<?php

namespace App\Http\Controllers\StudentControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student\Payments;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class PaymentDataController extends Controller
{
    public function paymentData(Request $request){
        $pi = $request->payment_intent;
        if(!str_contains($pi,'pi_')){
            return redirect('');
        }

        $payments = Payments::where('student_email','=', session()->get('student'))
                            ->where('payment_intent','=', $pi)
                            ->first();
        if(!$payments){
            return redirect('student/payments');
        }
        $data = compact('pi','payments');
        return view('student.payments.payment-data')->with($data);
    }

    public function PrintInvoice(Request $request){
        if(empty($request->payment_intent) || empty($request->date)){
            return redirect('')->with(['error' => 'No Payment Intent And Date founnd']);
        }
        $pi = $request->payment_intent;
        $date = $request->date;
        $payments = DB::table('payments')
                        ->join('students_logs','payments.student_email','=','students_logs.student_email')
                        ->where('payments.payment_intent','=', $pi)
                        ->first();
        if($payments){
            $pdf = Pdf::loadView('student.payments.invoice', compact('payments','date'));
            return $pdf->download('invoice_'.$pi.'.pdf');
        }
        else{
            return redirect()->back()->with(['error' => 'Something went wrong']);
        }
    } 
}
