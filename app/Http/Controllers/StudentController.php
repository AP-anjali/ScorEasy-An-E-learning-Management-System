<?php

namespace App\Http\Controllers;
use App\Models\students_info_table;
use App\Models\student_otp_table;
use App\Models\students_feedbacks_table;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function student_registration_page(){
        return view('student_registration_page');
    }

    public function student_login_page(){
        return view('student_login_page');
    }

    public function student_registration_form_submission_route(Request $request){
        echo "Hello from student_registration_form_submission_route";
        try{
            $validatedData = $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:students_info',
                'phone_no' => 'required|string|unique:students_info',
                'username' => 'required|string|unique:students_info',
                'password' => 'required|string',
                'confirm_password' => 'required|string|same:password',
            ], 
            [
                'name.required' => 'Please enter your name.',
            ]);
        }catch (\Illuminate\Validation\ValidationException $e) {
            $errorMessages = $e->validator->getMessageBag()->all();
        
            // Display error messages using JavaScript alerts
            echo '<script>';
            foreach ($errorMessages as $errorMessage) {
                echo 'alert("' . $errorMessage . '");';
            }
            echo '</script>';
            return;
        }

        $student = students_info_table::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone_no' => $request->input('phone_no'),
            'date_of_birth' => $request->input('date_of_birth'),
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password')),
            'confirm_password' => $request->input('confirm_password'),
        ]);

        if ($student) {
            // echo "data inserted successfully.....!";
            $usertype = ($request->input('user_type') == '1') ? '1' : '0';
            return redirect()->route('student_login_page');
        } else {
            echo "Error occured in data insertion";
        }
    }

    public function student_login_form_phone_no_submission_route(Request $request){
        echo "Hello From student_login_form_phone_no_submission_route";

        try {
            $validatedData = $request->validate([
                'phone_no' => 'required|exists:students_info,phone_no|regex:/^\+\d{1,3}(\s?\d+)+$/',
            ],
            [
                'phone_no.required' => 'Please provide a phone number.',
                'phone_no.regex' => 'Please enter a valid phone number with a country code.',
                'phone_no.exists' => 'The provided phone number is not registered.',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errorMessages = $e->validator->getMessageBag()->all();
        
            // Display error messages using JavaScript alerts
            echo '<script>';
            foreach ($errorMessages as $errorMessage) {
                echo 'alert("' . $errorMessage . '");';
            }
            echo '</script>';
            return;
        }

        $phone_no = $request->input('phone_no');
        $user = students_info_table::where('phone_no', $request->phone_no)->first();
        if($user)
        {
            echo "<br>Mobile no is valid...";
            $userOtp = $this->generateOTPS($request, $request->phone_no);
            $userOtp->sendSMS($request->phone_no);
            echo "<br><h1>OTP HAS BEEN SENT GO BACK AND ENTER OTP AND CONTINUE TO LOGIN...</h1>";
            Session::put('phone_no', $phone_no);

            $now = now();
            session()->flash('otp_sent_at', $now);
            session()->put('otp_sent', true);
            
            Session::put('phone_no', $phone_no);
            session()->flash('otp_sent', true);
            return redirect()->route('student_otp_verification',['s_id'=>$userOtp->s_id])->with('otp_sent', true);
        }else{
            echo "<br>Mobile no is invalid...";
        }
    }

    public function generateOTPS(Request $request, $phone_no)
    {
        $user = students_info_table::where('phone_no', $request->phone_no)->first();
        $userOtp = student_otp_table::where('s_id',$user->id)->latest('created_at')->first();

        $now = now();

        if($userOtp && $now->isBefore($userOtp->otp_expires_at))
        {
            return $userOtp;
        }

        return student_otp_table::updateOrCreate(['s_id'=>$user->id],[
            's_id' => $user->id,
            'otp' => rand(100000, 999999),
            'otp_expires_at' => $now->addMinutes(5)
        ]);
    }

    public function student_otp_verification($s_id)
    {
        return view('student_login_page',compact('s_id'));
    }

    public function student_login_otp_verification_route(Request $request){
        echo "Hello From student_login_otp_verification_route";

        try {
            $validatedData = $request->validate([
                'otp' => 'required|digits:6',
            ],
            [
                'otp.required' => 'Please provide the OTP.',
                'otp.digits' => 'The OTP must be a 6-digit number.',
            ]);

            $userOtp = student_otp_table::where('s_id', $request->s_id)->where('otp', $request->otp)->first();

            $now = now();

            if(!$userOtp)
            {
                return "<br><h1>OTP is incorrect...</h1>";
            }
            else if($userOtp && $now->isAfter($userOtp->otp_expires_at))
            {
                return "<br><h1>This OTP has been expired please request new OTP...</h1>";
            }

            $user = students_info_table::whereId($request->s_id)->first();

            if($user)
            {
                $userOtp->update([
                    'otp_expires_at' => now()
                ]);
                echo "<br><h1>OTP CORRECT...</h1>";
                Session::put('user', $user);
                Session::forget('phone_no');
                if($user->user_type == '1')
                {
                    return redirect()->route('admin_login_username_password_verification_page');
                }
                else
                {
                    return redirect()->route('student_login_username_password_verification_page');
                }
                // echo "<br><h1>OTP CORRECT...</h1>";
            }  
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errorMessages = $e->validator->getMessageBag()->all();

            // Echo the error messages
            echo '<br><h2 style="color: red;">You cannot Login due to following errors :</h2><br>';
            foreach ($errorMessages as $errorMessage) {
                echo '<center>' . '<h1>'. $errorMessage . '<br>' . '</h1>' . '</center>';
            }

            return;
        }
    }

    public function student_login_username_password_verification_page(){
        return view('student_login_username_password_verification_page');
    }

    public function student_login_form_un_ps_submission_route(Request $request){

        echo "Hello form student_login_form_un_ps_submission_route";

        $username = $request->input('username');
        $password = $request->input('password');

        $user = students_info_table::where('username', $username)->first();
        if ($user) {
            echo "<br>Username is valid...";
    
            if (Hash::check($password, $user->password)){
                echo "<br>Password match...";
                echo "<center><h1>WELCOME TO OUR HOME PAGE</h1></center>";
                Session::put('student_session', $user);
                // dd(session('student_session'));
                // return redirect()->route('student_dashboard');
                return redirect('/');
            } else {
                echo '<h2 style="color: red; margin:0 0 0 50px;">'. "<br><br>Error Occured :" . '</h2>' . '<center>' . '<h1>'. "<br>Incorrect Password" . '<br>' . '</h1>' . '</center>'; 
                // echo "<br>Provided Password: " . $password;
                // echo "<br>Hashed Password from Database: " . $user->password;
            }
        } else {
            echo '<h2 style="color: red; margin:0 0 0 50px;">'. "<br><br>Error Occured :" . '</h2>' . '<center>' . '<h1>'. "<br>Username is invalid..." . '<br>' . '</h1>' . '</center>'; 
        }

    }

    public function students_first_window(){
        $allStudentFeedbacks = students_feedbacks_table::with('student')->get();
        return view('students_first_window', compact('allStudentFeedbacks'));
    }

    public function main_student_feedback_form(){
        $student_session = Session::get('student_session');
        return view('main_student_feedback_form', compact('student_session'));
    }

    public function student_feedback_form_submission(Request $request, $student_id)
    {
        $request->validate([
            'rating' => 'required|numeric|min:1|max:5',
            'feedback' => 'required|string|max:255',
        ]);

        students_feedbacks_table::create([
            'student_id' => $student_id,
            'rating' => $request->rating,
            'feedback' => $request->feedback,
        ]);

        return view('student_feedback_submitted_page');

    }

    public function student_feedback_submitted_page()
    {
        return view('student_feedback_submitted_page');
    }

    public function student_logout(){
        if(Session::has('student_session')){
            Session::pull('student_session');
            // dd(session('student_session'));
            return redirect('/');
        }
    }
}
