<?php

namespace App\Http\Controllers;
use App\Models\faculties_table;
use App\Models\faculties_info_table;
use App\Models\FacultyOtp;
use App\Models\faculty_otp_table;
use App\Models\FacultyUnPs;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\faculties_feedbacks_table;

class FacultyController extends Controller
{

    public function faculities_first_window(){
        $allFacultyFeedbacks = faculties_feedbacks_table::with('faculty')->get();
        return view('faculities_first_window', compact('allFacultyFeedbacks'));
    }


    function faculty_reg_log()
    {
        return view('faculty_reg_log');
    }

    function datainsertfaculty(Request $request){
        // echo "hello from datainsertfaculty";
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|regex:/^[a-zA-Z\s]+$/',
                'phone_no' => 'required|unique:faculties,phone_no|regex:/^\+(\d{1,3})?\s?\d{10}$/',
                'email' => 'required|string|unique:faculties,email|email',
            ],
            [
                'name.required' => 'Please enter your name.',
                'name.alpha' => 'Your name should only contain alphabetical characters.',
                'phone_no.required' => 'Please provide a phone number.',
                'phone_no.unique' => 'This phone number is already in use.',
                'phone_no.regex' => 'Please enter a valid phone number with a country code.',
                'email.required' => 'Please enter your mail id.',
                'email.string' => 'Your email id should be a string.',
                'email.email' => 'Please enter a valid email address.',
                // Other custom error messages for your form fields.
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errorMessages = $e->validator->getMessageBag()->all();
    
            // Echo the error messages
            echo '<br><h2 style="color: red;">You cannot register due to following errors :</h2><br>';
            foreach ($errorMessages as $errorMessage) {
                echo '<center>' . '<h1>'. $errorMessage . '<br>' . '</h1>' . '</center>';
            }
    
            // Handle other logic or return a response as needed
            return;
        }

        $name = $request->input('name');
        $phone_no = $request->input('phone_no');
        $email = $request->input('email');

        $isinsertsuccessfull = faculties_table::insert(['name'=>$name, 'phone_no'=>$phone_no, 'email'=>$email]);

        if($isinsertsuccessfull)
        {
            $facultyId = faculties_table::where('phone_no', $phone_no)->value('id');
            // $usertype = Auth::user()->usertype;
            return redirect()->route('faculty_un_ps', ['id' => $facultyId]);
        }  
        else
        {
            echo '<h1>Failed to create account</h1>';
        } 
    }

    function faculty_un_ps($id){
        return view('faculty_un_ps', ['id' => $id]);
    }

    function facultyUnPs(Request $request, $id){
        // echo "Hello from facultyUnPs function";
        try {
            $validatedData = $request->validate([
                'username' => 'required|unique:faculty_un_ps,username',
                'password' => 'required|min:8|max:15',
                'confirm_password' => 'required|min:8|max:15|same:password',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errorMessages = $e->validator->getMessageBag()->all();
    
            echo '<br><h2 style="color: red;">You cannot register due to following errors :</h2><br>';
            foreach ($errorMessages as $errorMessage) {
                echo '<center>' . '<h1>'. $errorMessage . '<br>' . '</h1>' . '</center>';
            }
    
            return;
        }

        // $id = $request->input('f_id');
        $username = $request->input('username');
        $password = $request->input('password');
        $confirm_password = $request->input('confirm_password');

        $hashedPassword = Hash::make($request->input('password'));

        $isinsertsuccessfull = FacultyUnPs::insert(['f_id' => $id, 'username'=>$username, 'password'=>$hashedPassword, 'confirm_password'=>$confirm_password]);

            if($isinsertsuccessfull)
            {
                // echo '<h1>Username and password created successfully...</h1>';
                return redirect()->route('faculty_dashboard');
            } 
            else
            {
                echo '<h1>Failed to create username and password</h1>';
            } 

    }

    public function faculty_dashboard()
    {
        $user = Auth::user();
        return view('faculty_dashboard', ['user' => $user]);
    }

    public function generatefaculty(Request $request)
    {
        echo "Hello from generatefaculty function";

        try {
            $validatedData = $request->validate([
                'phone_no' => 'required|exists:faculties,phone_no|regex:/^\+\d{1,3}(\s?\d+)+$/',
            ],
            [
                'phone_no.required' => 'Please provide a phone number.',
                'phone_no.regex' => 'Please enter a valid phone number with a country code.',
                'phone_no.exists' => 'The provided phone number is not registered.',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errorMessages = $e->validator->getMessageBag()->all();
    
            // Echo the error messages
            echo '<br><h2 style="color: red;">You cannot Login due to following errors :</h2><br>';
            foreach ($errorMessages as $errorMessage) {
                echo '<center>' . '<h1>'. $errorMessage . '<br>' . '</h1>' . '</center>';
            }
    
            // Handle other logic or return a response as needed
            return;
        }

        $phone_no = $request->input('phone_no');
        $user = faculties_table::where('phone_no', $request->phone_no)->first();
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
            return redirect()->route('verificationF',['f_id'=>$userOtp->f_id])->with('otp_sent', true);

        }else{
            echo "<br>Mobile no is invalid...";
        }

    }

    public function verificationF($f_id)
    {
        return view('faculty_reg_log',compact('f_id'));
    }

    function loginuserfaculty(Request $request){
        echo "Hello from loginuserfaculty function";

        try {
            $validatedData = $request->validate([
                'otp' => 'required|digits:6',
            ],
            [
                'otp.required' => 'Please provide the OTP.',
                'otp.digits' => 'The OTP must be a 6-digit number.',
            ]);
        
        

            $userOtp = FacultyOtp::where('f_id', $request->f_id)->where('otp', $request->otp)->first();

            $now = now();

            if(!$userOtp)
            {
                return "<br><h1>OTP is incorrect...</h1>";
            }
            else if($userOtp && $now->isAfter($userOtp->otp_expires_at))
            {
                return "<br><h1>This OTP has been expired please request new OTP...</h1>";
            }

            $user = faculties_table::whereId($request->f_id)->first();

            if($user)
            {
                $userOtp->update([
                    'otp_expires_at' => now()
                ]);
                // Auth::login($user);
                Session::put('user', $user);
                Session::forget('phone_no');
                if($user->usertype == '1')
                {
                    return redirect()->route('admin_verify_un_ps');
                }
                else
                {
                    return redirect()->route('faculty_un_ps_verify');
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

    public function faculty_un_ps_verify()
    {
        return view('faculty_un_ps_verify');
    }

    public function generateOTPS(Request $request, $phone_no)
    {
        $user = faculties_table::where('phone_no', $request->phone_no)->first();
        $userOtp = FacultyOtp::where('f_id',$user->id)->latest('created_at')->first();

        $now = now();

        if($userOtp && $now->isBefore($userOtp->otp_expires_at))
        {
            return $userOtp;
        }

        return FacultyOtp::updateOrCreate(['f_id'=>$user->id],[
            'f_id' => $user->id,
            'otp' => rand(100000, 999999),
            'otp_expires_at' => $now->addMinutes(1)
        ]);
    }

    public function faculty_un_ps_verification_method(Request $request)
    {
        echo "hello from faculty_un_ps_verification_method";
        $username = $request->input('username');
        $password = $request->input('password');

        $user = FacultyUnPs::where('username', $username)->first();
        if ($user) {
            echo "<br>Username is valid...";
    
            if (Hash::check($password, $user->password)){
                echo "<br>Password match...";
                echo "<center><h1>WELCOME TO OUR HOME PAGE</h1></center>";
                return redirect()->route('faculty_dashboard');
            } else {
                echo '<h2 style="color: red; margin:0 0 0 50px;">'. "<br><br>Error Occured :" . '</h2>' . '<center>' . '<h1>'. "<br>Incorrect Password" . '<br>' . '</h1>' . '</center>'; 
                // echo "<br>Provided Password: " . $password;
                // echo "<br>Hashed Password from Database: " . $user->password;
            }
        } else {
            echo '<h2 style="color: red; margin:0 0 0 50px;">'. "<br><br>Error Occured :" . '</h2>' . '<center>' . '<h1>'. "<br>Username is invalid..." . '<br>' . '</h1>' . '</center>'; 
        }
    } 

    public function deleteAndGoHome($id)
    {
        DB::table('faculties')->where('id', $id)->delete();

        return redirect()->route('home');
    }

    // ======================================================================================================================

    public function faculty_registration_page(){
        return view('faculty_registration_page');
    }

    public function faculty_login_page(){
        return view('faculty_login_page');
    }

    public function faculty_registration_form_submission_route(Request $request){
        echo "hello from faculty_registration_form_submission_route";
        // die;
        try{
            $validatedData = $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:faculties_informations',
                'phone_no' => 'required|string|unique:faculties_informations',
                'date_of_birth' => 'required|string',
                'username' => 'required|string|unique:faculties_informations',
                'password' => 'required|string',
                'confirm_password' => 'required|string|same:password',
                'bank_name' => 'required|string',
                'bank_branch' => 'required|string',
                'bank_ifsc_code' => 'required|string',
                'bank_micr_code' => 'required|numeric',
                'account_holder_name' => 'required|string',
                'account_number' => 'required|string',
                'account_type' => 'required|string',
                'proof_of_bank_account_ownership' => 'required|file|mimes:pdf,doc,docx',
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

        $proofOfOwnership = $request->file('proof_of_bank_account_ownership');
        $proofPath = $proofOfOwnership->store('proof_of_bank_account_ownership', 'public');

        $faculty = faculties_info_table::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone_no' => $request->input('phone_no'),
            'date_of_birth' => $request->input('date_of_birth'),
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password')),
            'confirm_password' => $request->input('confirm_password'),
            'bank_name' => $request->input('bank_name'),
            'bank_branch' => $request->input('bank_branch'),
            'bank_ifsc_code' => $request->input('bank_ifsc_code'),
            'bank_micr_code' => $request->input('bank_micr_code'),
            'account_holder_name' => $request->input('account_holder_name'),
            'account_number' => $request->input('account_number'),
            'account_type' => $request->input('account_type'),
            'proof_of_bank_account_ownership_file_name' => $proofOfOwnership->getClientOriginalName(),
            'proof_of_bank_account_ownership_file_path' => $proofPath,
        ]);

        if ($faculty) {
            // echo "data inserted successfully.....!";
            return redirect()->route('faculty_login_page');
        } else {
            echo "Error occured in data insertion";
        }
    }

    public function faculty_login_form_phone_no_submission_route(Request $request){
        echo "Hello from faculty_login_form_phone_no_submission_route";

        try {
            $validatedData = $request->validate([
                'phone_no' => 'required|exists:faculties_informations,phone_no|regex:/^\+\d{1,3}(\s?\d+)+$/',
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
        $user = faculties_info_table::where('phone_no', $request->phone_no)->first();
        if($user)
        {
            echo "<br>Mobile no is valid...";
            $userOtp = $this->generateOTPF($request, $request->phone_no);
            $userOtp->sendSMS($request->phone_no);
            echo "<br><h1>OTP HAS BEEN SENT GO BACK AND ENTER OTP AND CONTINUE TO LOGIN...</h1>";
            Session::put('phone_no', $phone_no);

            $now = now();
            session()->flash('otp_sent_at', $now);
            session()->put('otp_sent', true);
            
            Session::put('phone_no', $phone_no);
            session()->flash('otp_sent', true);
            return redirect()->route('faculty_otp_verification',['f_id'=>$userOtp->f_id])->with('otp_sent', true);
        }else{
            echo "<br>Mobile no is invalid...";
        }        
    }

    public function generateOTPF(Request $request, $phone_no)
    {
        $user = faculties_info_table::where('phone_no', $request->phone_no)->first();
        $userOtp = faculty_otp_table::where('f_id',$user->id)->latest('created_at')->first();

        $now = now();

        if($userOtp && $now->isBefore($userOtp->otp_expires_at))
        {
            return $userOtp;
        }

        return faculty_otp_table::updateOrCreate(['f_id'=>$user->id],[
            'f_id' => $user->id,
            'otp' => rand(100000, 999999),
            'otp_expires_at' => $now->addMinutes(5)
        ]);
    }

    public function faculty_otp_verification($f_id)
    {
        return view('faculty_login_page',compact('f_id'));
    }

    public function faculty_login_otp_verification_route(Request $request){
        echo "Hello from faculty_login_otp_verification_route";

        try {
            $validatedData = $request->validate([
                'otp' => 'required|digits:6',
            ],
            [
                'otp.required' => 'Please provide the OTP.',
                'otp.digits' => 'The OTP must be a 6-digit number.',
            ]);

            $userOtp = faculty_otp_table::where('f_id', $request->f_id)->where('otp', $request->otp)->first();

            $now = now();

            if(!$userOtp)
            {
                return "<br><h1>OTP is incorrect...</h1>";
            }
            else if($userOtp && $now->isAfter($userOtp->otp_expires_at))
            {
                return "<br><h1>This OTP has been expired please request new OTP...</h1>";
            }

            $user = faculties_info_table::whereId($request->f_id)->first();

            if($user)
            {
                $userOtp->update([
                    'otp_expires_at' => now()
                ]);
                echo "<br><h1>OTP CORRECT...</h1>";
                Session::put('user', $user);
                Session::forget('phone_no');
                return redirect()->route('faculty_login_username_password_verification_page');
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

    public function faculty_login_username_password_verification_page(){
        return view('faculty_login_username_password_verification_page');
    }

    public function faculty_login_form_un_ps_submission_route(Request $request){
        echo "Hello From faculty_login_form_un_ps_submission_route";

        $username = $request->input('username');
        $password = $request->input('password');

        $user = faculties_info_table::where('username', $username)->first();
        if ($user) {
            echo "<br>Username is valid...";
    
            if (Hash::check($password, $user->password)){
                echo "<br>Password match...";
                echo "<center><h1>WELCOME TO OUR HOME PAGE</h1></center>";
                Session::put('faculty_session', $user);
                // dd(session('faculty_session'));
                // return redirect()->route('faculty_dashboard');
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

    public function faculty_logout(){
        if(Session::has('faculty_session')){
            Session::pull('faculty_session');
            // dd(session('faculty_session'));
            return redirect('/');
        }
    }
}
