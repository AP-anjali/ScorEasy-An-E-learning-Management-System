<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Log;
use Exception;
use Carbon\Carbon;
use App\Models\students_info_table;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubscriptionPaymentSuccessfulMail;
use App\Models\subscriptions_table;
use App\Models\subscribed_students_table;
use Razorpay\Api\Api;


class RazorpayPaymentController extends Controller
{

    public function subscription_payment_by_students(Request $request)
    {
        $input = $request->all();

        $api = new Api(env('RAZORPAY_API_KEY'), env('RAZORPAY_API_SECRET'));
        $payment = $api->payment->fetch($input['razorpay_payment_id']);
        if (count($input) && !empty($input['razorpay_payment_id'])) 
        {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture([
                    'amount' => $payment['amount']
                ]);

                $record = new subscribed_students_table;

                $student_id = $request->input('student_id');
                $subscription_id = $request->input('subscription_id');

                $record->student_id = $student_id;
                $actual_amount = $payment['amount'];
                $record->total_amount = $actual_amount;
                $record->transaction_id = $payment->id;
                $record->payment_id = $payment->id;
                $record->payment_status = $payment->status;
                $record->payment_info = json_encode($payment->toArray());

                $record->subscription_id = $subscription_id;

                $subscription = subscriptions_table::findOrFail($subscription_id);
                $startDate = Carbon::now()->setTimezone('Asia/Kolkata')->format('d/m/y h:i:s A');
                $endDate = $this->calculateSubscriptionEndDate($startDate, $subscription->subscription_duration_number, $subscription->subscription_duration_unit);

                $record->subscription_start_date = $startDate;
                $record->subscription_end_date = $endDate;

                $record->save();

                $subscribed_student = students_info_table::find($student_id);
                $subscribed_student->is_subscribed = 1;
                $subscribed_student->save();

                Session::forget('student_session');
                Session::put('student_session', $subscribed_student);

                $this->sendSubscriptionPaymentDoneMail($subscribed_student->email);

            } catch (Exception $e) {
                Log::info($e->getMessage());
                return back()->withError($e->getMessage());
            }
        }
        return redirect()->back()->with('payment_done', 'Payment Done, Now You are subscribed user !');
    }

    private function sendSubscriptionPaymentDoneMail($email)
    {
        Mail::to($email)->send(new SubscriptionPaymentSuccessfulMail($email));
    }

    function calculateSubscriptionEndDate($startDate, $durationNumber, $durationUnit)
    {
        $startDate = Carbon::createFromFormat('d/m/y h:i:s A', $startDate, 'Asia/Kolkata');

        switch ($durationUnit) {
            case 'Days':
                $endDate = $startDate->copy()->addDays($durationNumber);
                break;
            case 'Weeks':
                $endDate = $startDate->copy()->addWeeks($durationNumber);
                break;
            case 'Months':
                $endDate = $startDate->copy()->addMonths($durationNumber);
                break;
            case 'Years':
                $endDate = $startDate->copy()->addYears($durationNumber);
                break;
            default:
                $endDate = "Error Occured, due to invalid case";
        }

        return $endDate->format('d/m/y h:i:s A');
    }

    public function for_apply_middleware_on_payment_button()
    {
        return view('for_apply_middleware_on_payment_button');
    }
}
