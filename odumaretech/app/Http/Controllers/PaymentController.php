<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Course;
use App\Models\AppliedCourse;
use Auth;
class PaymentController extends Controller
{
    public function makePayment(Request $request){
        $request->validate([
            'amount'          =>  'required',
        ]);
        
      if($request->payment == "paystack"){
        
        $referenceId = "OdumareTech".rand(0, 100000000);

        $course_detail = Course::where('id', '=', $request->course_id)->first();
        $actual_cost = $course_detail->price;

        if($request->payment_type == "partial"){
            $amount = 0.7 * $actual_cost;
        }else{
            $amount = $request->amount;
        }

        $payment = new Payment;
        $payment->referenceId = $referenceId;
        $payment->payment = $request->payment;
        $payment->amount = $amount;
        $payment->user_email = $request->user_email;
        $payment->status = "pending";
        $payment->admission_status = "accepted";
        $payment->course_id = $request->course_id;
        $payment->payment_type = $request->payment_type;
        $payment->save();
        $formData = [
            'email' => $request->user_email,
            'amount' => $amount * 100,
            'currency' => "NGN",
            'metadata' => [ 'referenceId' => $referenceId],
            'callback_url' => route('pay.callback')
        ];

        $pay =json_decode($this->initializePayment($formData));
        if ($pay) {
            if ($pay->status) {
                return redirect($pay->data->authorization_url);
            } else {
                $notification = array(
                    'message' => 'try again later',
                    'alert-type' => 'error'
                );
        
                return back()->with($notification);
            }
            
        } else {
            return back()->withError('something went wrong');
        }
        
      }else{
    //     $checkIn = $request->checkIn;
    //     $checkOut = $request->checkOut;
    //     $guest = $request->guest;
    //     $price = $request->price;
    //     $user_email = $request->user_email;
    //     $bookingId = "WindSor".rand(0, 100000);

    //     $datetime1 = new DateTime($checkIn);
    //     $datetime2 = new DateTime($checkOut);
    //     $interval = $datetime1->diff($datetime2);
    //     $days = $interval->format('%a');//now do whatever you like with $days
    //     $amount = $price * $days * 100;
    //     $amount_to_save = $amount/100;
    //     $newBooking = new BookingOrder;

    //     $newBooking->bookingId = $bookingId;
    //     $newBooking->checkIn = $request->checkIn;
    //     $newBooking->checkOut = $request->checkOut;
    //     $newBooking->user_email = $request->user_email;
    //     $newBooking->apartment_id = $request->apartment_id;
    //     $newBooking->guest = $guest;
    //     $newBooking->price = $amount_to_save;
    //     $newBooking->payment_status = "Not Paid";
    //     $newBooking->payment_method = "Offline";
    //     $newBooking->reference = "Not Specified";
    //     $newBooking->save();

    //     $updateRoom = Room::findOrFail($request->apartment_id);
    //     $updateRoom->status = "Unavailable";
    //     $updateRoom->save();
    //     $notification = array(
    //         'message' => 'Reservation will be removed within 24hours',
    //         'alert-type' => 'success'
    //     );

    //     return redirect()->route('booking.user')->with($notification);
    //   }
    }
}

    public function initializePayment($formData){
        $url = "https://api.paystack.co/transaction/initialize";
        $field_string = http_build_query($formData);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $field_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer " . env("PAYSTACK_SECRET_KEY"),
            "Cache-control: no-cache"
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
 
    public function verifyPayment($reference){
        $curl = curl_init();
        curl_setopt_array($curl, array(
         CURLOPT_URL => "https://api.paystack.co/transaction/verify/$reference",
         CURLOPT_RETURNTRANSFER => true,
         CURLOPT_ENCODING => "",
         CURLOPT_MAXREDIRS => 10,
         CURLOPT_TIMEOUT => 30,
         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
         CURLOPT_CUSTOMREQUEST => "GET",
         CURLOPT_HTTPHEADER => array(
             "Authorization: Bearer " . env("PAYSTACK_SECRET_KEY"),
             "Cache-control: no-cache"
         )
        ));
 
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    public function paymentCallback(){
        $response = json_decode($this->verifyPayment(request('reference')));
        
        $data = $response->data;
        $reference = $data->reference;
        // dd($reference);
        $referenceId = $data->metadata->referenceId;
        // dd($bookingId);
        if ($response) {
    
            Payment::where('referenceId',$referenceId)->update(['status' => "paid"]);
            $get_payment_details = Payment::where('referenceId', '=', $referenceId)->first();
            $applied_course = new AppliedCourse;
            $applied_course->user_id = Auth::user()->id;
            $applied_course->course_id = $get_payment_details->course_id;
            $applied_course->status = "pending";
            $applied_course->payment_type = $get_payment_details->payment_type;
            $applied_course->admission_status = "accepted";
            $applied_course->payment_id = $get_payment_details->id;
            $applied_course->save();
         
            $notification = array(
                'message' => 'Payment successful',
                'alert-type' => 'success'
            );
    
            return redirect()->route('user.dashboard')->with($notification);
        } else {
            return back()->withError('something went wrong');
        }
      
    }

    public function transactions(){
        $payments = Payment::all();
        return view('admin.payment', compact('payments'));
    }

    public function transactions_user(){
        $payments = Payment::where('user_email', '=', Auth::user()->email)->get();
        return view('user.payment', compact('payments'));
    }
 

    public function user_complete(Request $request, $id){ 
      if($request->payment == "paystack"){
        $course_detail = Course::where('id', '=', $request->course_id)->first();
        $actual_cost = $course_detail->price;
        $amount = 0.3 * $actual_cost;

        $payment_details = Payment::findOrFail($id);
        
        $formData = [
            'email' => $payment_details->user_email,
            'amount' => $amount * 100,
            'currency' => "NGN",
            'metadata' => [ 'referenceId' => $payment_details->referenceId],
            'callback_url' => route('pay.callback.user.complete')
        ];

        $pay =json_decode($this->initializePayment($formData));
        if ($pay) {
            if ($pay->status) {
                return redirect($pay->data->authorization_url);
            } else {
                $notification = array(
                    'message' => 'try again later',
                    'alert-type' => 'error'
                );
        
                return back()->with($notification);
            }
            
        } else {
            return back()->withError('something went wrong');
        }
        
      }else{

    }
}


public function user_complete_callback(){
    $response = json_decode($this->verifyPayment(request('reference')));
    
    $data = $response->data;
    $reference = $data->reference;
    $referenceId = $data->metadata->referenceId;
    if ($response) {
        Payment::where('referenceId',$referenceId)->update(['status' => "paid", "payment_type" => "full", "admission_status" => "accepted"]);
        $get_payment_details = Payment::where('referenceId', '=', $referenceId)->first();
        $course_detail = Course::where('id', '=', $get_payment_details->course_id)->first();
        Payment::where('referenceId', '=', $referenceId)->update(['amount' => $course_detail->price]);

        AppliedCourse::where('payment_id', '=', $get_payment_details->id)->update(['payment_type' => 'full', 'admission_status' => 'accepted']);
        
        $notification = array(
            'message' => 'Payment successful',
            'alert-type' => 'success'
        );

        return redirect()->route('transaction.user.all')->with($notification);
    } else {
        return back()->withError('something went wrong');
    }
  
}

}
