<?php

namespace App\Http\Controllers\StudentControllers;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Student\Payments;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\PaymentIntent;

class CheckoutController extends Controller
{
  public function GenerateCheckout(Request $request){
      if($request->ajax()){
        $validator = Validator::make($request->all(), [
          'billing_email' => 'email|required',
          'student_email' => 'email|required',
        ]);

        if($validator->fails()){
          return response()->json(['error' => 'Please enter valid details'], 422);
        }

        //Get Page(site) url
        $url = url('');

        //Set Api Key
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $stripe = Session::create([
          'payment_method_types' => ['card'],
          'line_items' => [[
            'price_data' => [
              'currency' => 'inr',
              'product_data' => [
                  'name' => 'School Fees'
              ],

              'unit_amount' => 230000,
            ],
            'quantity' => '1'
          ]],
          'mode' => 'payment',
          'customer_email' => $request->billing_email,
          'success_url' => $url.'/student/payment/complete?payment_session='.'{CHECKOUT_SESSION_ID}'.'&billing_email='.$request->billing_email.'&payment_status=succeed',
          'cancel_url' => $url.'/?payment_cancel=1',
        ]);

        //Get Payments Data
        $id = $stripe->id;

        //Insert Data to DB For verification purpose
        $payment = new  Payments;
        $payment->student_email = $request->student_email;
        $payment->billing_email = $request->billing_email;
        $payment->payment_amount = 2300;
        $payment->payment_id = $id;
        $payment->status = 0;
        $payment->invoice = 'invoice_'.random_int(999,9999);
        if($payment->save()){
          return response()->json([
            'payment_method_types' => 'card',
            'billing_details' => [
              'customer_email' => $request->email,
              'price' => '2300',
            ],
            'checkout' => $stripe->url,
          ]);
        }
      }
      else{
        return response()->json(['message' => 'This Method is not supported']);
      }
  }

  public function CheckoutComplete(Request $request){
  if(!$request->has('payment_session')){
    return redirect('/');
  }
  else{
    if(is_null($request->payment_session) || $request->payment_session === ''){
      return redirect('/');
    }

      $cs = Payments::where('payment_id','=',$request->payment_session)
                    ->first();
      if(!$cs){
        return redirect('/');
      }
      else{
        Stripe::setApiKey(env('STRIPE_SECRET'));
      //Session
        $id = $request->payment_session;

      //Session DATA
        $PI = Session::retrieve($id);
        $capture = PaymentIntent::retrieve($PI->payment_intent);
        $charge = Charge::retrieve($capture->latest_charge);
        $network = $charge['payment_method_details']['card']['brand'];
        $last4 = $charge['payment_method_details']['card']['last4'];

        switch ($network) {
          case 'mastercard':
            $brand = 'm';
            break;
          case 'visa':
            $brand = 'v';
            break;
        }

        echo '<pre>';
        //Update PaymentIntents
        $cs->payment_intent = $PI->payment_intent;
        $cs->payment_method = $capture->payment_method;
        $cs->latest_charge = $capture->latest_charge;
        $cs->brand = $brand;
        $cs->last_4 = $last4;
        $cs->status = 1;
        if($cs->save()){
          return redirect('/students/payment/pay-fee?payment_status=succeed')->with(['success' => 'Your Payment Has been recived..']);
        }
        else{
          return response()->json(['message' => 'Something Went Wrong']);
        }
      }
    }
  }

  public function MyPaymentData(){
    $payments = Payments::where('student_email','=', session()->get('student'))
                        ->get();
    $data = compact('payments');
    // return $payments;
    return view('student.payments.payments-history')->with($data);
  }
}
