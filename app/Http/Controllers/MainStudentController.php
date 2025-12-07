<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\students_info_table;
use App\Models\student_email_verification_table;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\StudentVerificationMail;


class MainStudentController extends Controller
{

    public function student_account($student_id)
    {
        $student_data = students_info_table::find($student_id);
        return view('showing_logged_in_student_account', compact('student_data'));
    }

    public function sending_email_for_verify_student_user($student_id)
    {
        $student_to_sent_an_email = students_info_table::find($student_id);

        $userVerificationCode = student_email_verification_table::where('student_id',$student_to_sent_an_email->id)->latest('varification_code_created_at')->first();

        $now = now();

        if($userVerificationCode && $now->isBefore($userVerificationCode->varification_code_expires_at))
        {
            $verification_code = $userVerificationCode->varification_code;
        }
        else
        {
            $verification_code = Str::random(26);
        }

        $this->sendVerificationCodeEmailToStudent($student_to_sent_an_email->email, $verification_code);
        
        student_email_verification_table::updateOrCreate(['student_id'=>$student_to_sent_an_email->id],[
            'student_id' => $student_to_sent_an_email->id,
            'varification_code' => $verification_code,
            'varification_code_expires_at' => $now->addMinutes(10)
        ]);

        Session::put('mail_has_been_sent_to_user', true);

        return redirect()->back();
    }

    private function sendVerificationCodeEmailToStudent($email, $verification_code)
    {
        Mail::to($email)->send(new StudentVerificationMail($verification_code));
    }

    public function verifying_student_email_verification_code_form_submission($student_id, Request $request)
    {
        try {
            $validatedData = $request->validate([
                'varification_code' => 'required',
            ],
            [
                'varification_code.required' => 'Please provide the varification code',
            ]);

            $verification_code = student_email_verification_table::where('student_id', $student_id)->where('varification_code', $request->varification_code)->first();

            $now = now();

            if(!$verification_code)
            {
                // echo "<br><h1>Verification Code is incorrect...</h1>";
                Session::forget('mail_has_been_sent_to_user');
                return redirect()->back()->with('verification_code_incorrect', 'Verification Code Not Match !');
            }
            else if($verification_code && $now->isAfter($verification_code->varification_code_expires_at))
            {
                // echo "<br><h1>This Verification Code has been expired please request new Verification Code...</h1>";
                Session::forget('mail_has_been_sent_to_user');
                return redirect()->back()->with('verification_code_expires', 'Verification code has been expired, please request new one !');
            }

            $user = students_info_table::whereId($student_id)->first();

            if($user)
            {
                $verification_code->update([
                    'varification_code_expires_at' => now()
                ]);
                // echo "<br><h1>Verification Code is CORRECT...</h1>";
                Session::forget('mail_has_been_sent_to_user');
                return redirect()->back()->with('verification_code_correct', 'user verified');
            }  
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errorMessages = $e->validator->getMessageBag()->all();

            echo '<br><h2 style="color: red;">You cannot Login due to following errors :</h2><br>';
            foreach ($errorMessages as $errorMessage) {
                echo '<center>' . '<h1>'. $errorMessage . '<br>' . '</h1>' . '</center>';
            }

            return;
        }
    }

    public function updating_student_user_record_from_student_page_form_submission(Request $request, $id){
        $student_record_to_update = students_info_table::find($id);

        try {
            $validatedData = $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:students_info,email,' . $id,
                'phone_no' => 'required|string|unique:students_info,phone_no,' . $id,
                'date_of_birth' => 'required|string',
                'username' => 'required|string|unique:students_info,username,' . $id,
                'password' => 'nullable|string',
                'confirm_password' => 'required|string',
                'profile_pic' => 'image|mimes:jpeg,png,jpg',
            ], [
                'name.required' => 'Please enter your name.',
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

        $student_record_to_update->name = $request->input('name');
        $student_record_to_update->email = $request->input('email');
        $student_record_to_update->phone_no = $request->input('phone_no');
        $student_record_to_update->date_of_birth = $request->input('date_of_birth');
        $student_record_to_update->username = $request->input('username');
        
        if ($request->filled('confirm_password')) {
            $student_record_to_update->password = bcrypt($request->input('confirm_password'));
            $student_record_to_update->confirm_password = $request->input('confirm_password'); 
        }

        if ($request->hasFile('profile_pic')) {
            $fileNameWithExt = $request->file('profile_pic')->getClientOriginalName();
            
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            
            $extension = $request->file('profile_pic')->getClientOriginalExtension();
            
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
    
            $path = $request->file('profile_pic')->storeAs('public/img', $fileNameToStore);
    
            $student_record_to_update->profile_pic = 'img/'.$fileNameToStore;
        }
    
        $student_record_to_update->save();

        Session::forget('student_session');
        Session::put('student_session', $student_record_to_update);

        return redirect()->back()->with('student_record_to_update', 'Account updated successfully !');

    }

    public function deleting_student_account_from_student($id){
        $student_to_delete = students_info_table::find($id);
        $student_to_delete->delete();
        Session::forget('student_session');
        return redirect('/');
    }

    public function main_student_dashboard()
    {
        $student_session = Session::get('student_session');
        return view('main_student_dashboard', ['student_session' => $student_session]);
    }

    public function main_student_dashboard_show_subscribed_educators_page()
    {
        $student_session = Session::get('student_session');
        return view('main_student_dashboard_show_subscribed_educators_page', ['student_session' => $student_session]);
    }

    public function main_student_dashboard_show_history_page()
    {
        $student_session = Session::get('student_session');
        return view('main_student_dashboard_show_history_page', ['student_session' => $student_session]);
    }

    public function main_student_dashboard_show_videos_to_watch_later_page()
    {
        $student_session = Session::get('student_session');
        return view('main_student_dashboard_show_videos_to_watch_later_page', ['student_session' => $student_session]);
    }

    public function main_student_dashboard_show_PDFs_to_read_later_page()
    {
        $student_session = Session::get('student_session');
        return view('main_student_dashboard_show_PDFs_to_read_later_page', ['student_session' => $student_session]);
    }

    public function main_student_dashboard_show_saved_playlists_page()
    {
        $student_session = Session::get('student_session');
        return view('main_student_dashboard_show_saved_playlists_page', ['student_session' => $student_session]);
    }

    public function main_student_dashboard_show_liked_videos_page()
    {
        $student_session = Session::get('student_session');
        return view('main_student_dashboard_show_liked_videos_page', ['student_session' => $student_session]);
    }

    public function main_student_dashboard_show_liked_PDFs_page()
    {
        $student_session = Session::get('student_session');
        return view('main_student_dashboard_show_liked_PDFs_page', ['student_session' => $student_session]);
    }

    public function main_student_dashboard_show_total_access_time_page()
    {
        $student_session = Session::get('student_session');
        return view('main_student_dashboard_show_total_access_time_page', ['student_session' => $student_session]);
    }

    public function main_student_dashboard_show_all_exams_page()
    {
        $student_session = Session::get('student_session');
        return view('main_student_dashboard_show_all_exams_page', ['student_session' => $student_session]);
    }

    public function main_student_dashboard_show_attempted_exams_page()
    {
        $student_session = Session::get('student_session');
        return view('main_student_dashboard_show_attempted_exams_page', ['student_session' => $student_session]);
    }

    public function main_student_dashboard_show_progress_report_page()
    {
        $student_session = Session::get('student_session');
        return view('main_student_dashboard_show_progress_report_page', ['student_session' => $student_session]);
    }

    public function main_student_dashboard_show_progress_chart_page()
    {
        $student_session = Session::get('student_session');
        return view('main_student_dashboard_show_progress_chart_page', ['student_session' => $student_session]);
    }

    public function main_student_dashboard_show_badges_page()
    {
        $student_session = Session::get('student_session');
        return view('main_student_dashboard_show_badges_page', ['student_session' => $student_session]);
    }

    public function main_student_dashboard_show_certificates_page()
    {
        $student_session = Session::get('student_session');
        return view('main_student_dashboard_show_certificates_page', ['student_session' => $student_session]);
    }

    public function main_student_dashboard_show_course_completion_stamps_page()
    {
        $student_session = Session::get('student_session');
        return view('main_student_dashboard_show_course_completion_stamps_page', ['student_session' => $student_session]);
    }

    public function main_student_dashboard_show_all_comments_page()
    {
        $student_session = Session::get('student_session');
        return view('main_student_dashboard_show_all_comments_page', ['student_session' => $student_session]);
    }

    public function main_student_dashboard_show_all_notifications_page()
    {
        $student_session = Session::get('student_session');
        return view('main_student_dashboard_show_all_notifications_page', ['student_session' => $student_session]);
    }

    public function main_student_dashboard_contact_to_faculties_page()
    {
        $student_session = Session::get('student_session');
        return view('main_student_dashboard_contact_to_faculties_page', ['student_session' => $student_session]);
    }

    public function main_student_dashboard_contact_us_page()
    {
        $student_session = Session::get('student_session');
        return view('main_student_dashboard_contact_us_page', ['student_session' => $student_session]);
    }

    public function main_student_dashboard_show_all_subscriptions_page()
    {
        $student_session = Session::get('student_session');
        return view('main_student_dashboard_show_all_subscriptions_page', ['student_session' => $student_session]);
    }

    public function main_student_dashboard_show_my_subscriptions_page()
    {
        $student_session = Session::get('student_session');
        return view('main_student_dashboard_show_my_subscriptions_page', ['student_session' => $student_session]);
    }

    public function main_student_dashboard_show_payment_record_page()
    {
        $student_session = Session::get('student_session');
        return view('main_student_dashboard_show_payment_record_page', ['student_session' => $student_session]);
    }

    public function main_student_dashboard_show_my_schedule_page()
    {
        $student_session = Session::get('student_session');
        return view('main_student_dashboard_show_my_schedule_page', ['student_session' => $student_session]);
    }

    public function main_student_dashboard_show_calendar_page()
    {
        $student_session = Session::get('student_session');
        return view('main_student_dashboard_show_calendar_page', ['student_session' => $student_session]);
    }

    public function main_student_dashboard_settings_page()
    {
        $student_session = Session::get('student_session');
        return view('main_student_dashboard_settings_page', ['student_session' => $student_session]);
    }

    public function main_student_dashboard_about_us_page()
    {
        $student_session = Session::get('student_session');
        return view('main_student_dashboard_about_us_page', ['student_session' => $student_session]);
    }

    public function main_student_dashboard_contact_us_page_again()
    {
        $student_session = Session::get('student_session');
        return view('main_student_dashboard_contact_us_page_again', ['student_session' => $student_session]);
    }

    public function main_student_dashboard_help_and_support_page()
    {
        $student_session = Session::get('student_session');
        return view('main_student_dashboard_help_and_support_page', ['student_session' => $student_session]);
    }

    public function main_student_dashboard_show_documentation_page()
    {
        $student_session = Session::get('student_session');
        return view('main_student_dashboard_show_documentation_page', ['student_session' => $student_session]);
    }

    public function main_student_dashboard_show_profile_page()
    {
        $student_session = Session::get('student_session');
        return view('main_student_dashboard_show_profile_page', ['student_session' => $student_session]);
    }

    public function main_student_dashboard_customization_page()
    {
        $student_session = Session::get('student_session');
        return view('main_student_dashboard_customization_page', ['student_session' => $student_session]);
    }
}
