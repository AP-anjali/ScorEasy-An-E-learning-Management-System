<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use App\Models\tutorial_types_table;
use App\Models\Courses_info_table;
use App\Models\subjects_info_table;
use App\Models\languages_info_table;
use App\Models\video_tutorials_info_table;
use App\Models\pdf_tutorials_info_table;
use App\Models\faculties_info_table;
use App\Models\faculty_email_verification_table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use FFMpeg;
use FFMpeg\Coordinate\TimeCode;
use getID3;
use Spatie\PdfToImage\Pdf;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\FacultyVerificationMail;
use App\Models\faculties_feedbacks_table;

class MainFacultyController extends Controller
{

    public function faculty_account($faculty_id)
    {
        $faculty_data = faculties_info_table::find($faculty_id);
        return view('showing_logged_in_faculty_account', compact('faculty_data'));
    }

    public function sending_email_for_verify_faculty_user($faculty_id)
    {
        $faculty_to_sent_an_email = faculties_info_table::find($faculty_id);

        $userVerificationCode = faculty_email_verification_table::where('faculty_id',$faculty_to_sent_an_email->id)->latest('varification_code_created_at')->first();

        $now = now();

        if($userVerificationCode && $now->isBefore($userVerificationCode->varification_code_expires_at))
        {
            $verification_code = $userVerificationCode->varification_code;
        }
        else
        {
            $verification_code = Str::random(26);
        }

        $this->sendVerificationCodeEmailToFaculty($faculty_to_sent_an_email->email, $verification_code);
        
        faculty_email_verification_table::updateOrCreate(['faculty_id'=>$faculty_to_sent_an_email->id],[
            'faculty_id' => $faculty_to_sent_an_email->id,
            'varification_code' => $verification_code,
            'varification_code_expires_at' => $now->addMinutes(10)
        ]);

        Session::put('mail_has_been_sent_to_user', true);

        return redirect()->back();
    }

    private function sendVerificationCodeEmailToFaculty($email, $verification_code)
    {
        Mail::to($email)->send(new FacultyVerificationMail($verification_code));
    }

    public function verifying_faculty_email_verification_code_form_submission($faculty_id, Request $request)
    {
        try {
            $validatedData = $request->validate([
                'varification_code' => 'required',
            ],
            [
                'varification_code.required' => 'Please provide the varification code',
            ]);

            $verification_code = faculty_email_verification_table::where('faculty_id', $faculty_id)->where('varification_code', $request->varification_code)->first();

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

            $user = faculties_info_table::whereId($faculty_id)->first();

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

    public function showing_proof_of_bank_account_ownership_to_faculty_for_account($faculty_id)
    {
        $faculty_to_show_document = faculties_info_table::find($faculty_id);
        return view('showing_proof_of_bank_account_ownership_to_faculty_for_account', compact('faculty_to_show_document'));

    }

    public function updating_faculty_user_record_from_faculty_page_form_submission(Request $request, $id){
        $faculty_record_to_update = faculties_info_table::find($id);

        try {
            $validatedData = $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:faculties_informations,email,' . $id,
                'phone_no' => 'required|string|unique:faculties_informations,phone_no,' . $id,
                'date_of_birth' => 'required|string',
                'username' => 'required|string|unique:faculties_informations,username,' . $id,
                'password' => 'nullable|string',
                'confirm_password' => 'required|string',
                'profile_pic' => 'image|mimes:jpeg,png,jpg',
                'bank_name' => 'required|string',
                'bank_branch' => 'required|string',
                'bank_ifsc_code' => 'required|string',
                'bank_micr_code' => 'required|numeric',
                'account_holder_name' => 'required|string',
                'account_number' => 'required|string',
                'account_type' => 'required|string',
                'proof_of_bank_account_ownership' => 'nullable|file|mimes:pdf,doc,docx',
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

        $faculty_record_to_update->name = $request->input('name');
        $faculty_record_to_update->email = $request->input('email');
        $faculty_record_to_update->phone_no = $request->input('phone_no');
        $faculty_record_to_update->date_of_birth = $request->input('date_of_birth');
        $faculty_record_to_update->username = $request->input('username');
        
        if ($request->filled('confirm_password')) {
            $faculty_record_to_update->password = bcrypt($request->input('confirm_password'));
            $faculty_record_to_update->confirm_password = $request->input('confirm_password'); 
        }

        if ($request->hasFile('profile_pic')) {
            $fileNameWithExt = $request->file('profile_pic')->getClientOriginalName();
            
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            
            $extension = $request->file('profile_pic')->getClientOriginalExtension();
            
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
    
            $path = $request->file('profile_pic')->storeAs('public/img', $fileNameToStore);
    
            $faculty_record_to_update->profile_pic = 'img/'.$fileNameToStore;
        }

        $faculty_record_to_update->bank_name = $request->input('bank_name');
        $faculty_record_to_update->bank_branch = $request->input('bank_branch');
        $faculty_record_to_update->bank_ifsc_code = $request->input('bank_ifsc_code');
        $faculty_record_to_update->bank_micr_code = $request->input('bank_micr_code');
        $faculty_record_to_update->account_holder_name = $request->input('account_holder_name');
        $faculty_record_to_update->account_number = $request->input('account_number');
        $faculty_record_to_update->account_type = $request->input('account_type');

        if ($request->hasFile('proof_of_bank_account_ownership')) {
            Storage::delete($faculty_record_to_update->proof_of_bank_account_ownership_file_path);
    
            $proofOfOwnership = $request->file('proof_of_bank_account_ownership');
            $proofPath = $proofOfOwnership->store('proof_of_bank_account_ownership', 'public');
            $faculty_record_to_update->proof_of_bank_account_ownership_file_name = $proofOfOwnership->getClientOriginalName();
            $faculty_record_to_update->proof_of_bank_account_ownership_file_path = $proofPath;
        }
    
        $faculty_record_to_update->save();

        Session::forget('faculty_session');
        Session::put('faculty_session', $faculty_record_to_update);

        return redirect()->back()->with('faculty_record_to_update', 'Account updated successfully !');

    }

    public function deleting_faculty_account_from_faculty($id){
        $faculty_to_delete = faculties_info_table::find($id);
        $faculty_to_delete->delete();
        Session::forget('faculty_session');
        return redirect('/');
    }

    private function getPdfPageCount($pdfPath)
    {
        $content = File::get($pdfPath);
        $numMatches = preg_match_all("/\/Page\W/", $content, $dummy);
        return $numMatches;
    }

    // ========================== feedback page [start] =========================

    public function main_faculty_feedback_form(){
        $faculty_session = Session::get('faculty_session');
        return view('main_faculty_feedback_form', compact('faculty_session'));
    }

    public function faculty_feedback_form_submission(Request $request, $faculty_id)
    {
        $request->validate([
            'rating' => 'required|numeric|min:1|max:5',
            'feedback' => 'required|string|max:255',
        ]);

        faculties_feedbacks_table::create([
            'faculty_id' => $faculty_id,
            'rating' => $request->rating,
            'feedback' => $request->feedback,
        ]);

        return redirect()->route('faculty_feedback_submitted_page');

    }

    public function faculty_feedback_submitted_page()
    {
        return view("faculty_feedback_submitted_page");
    }

    // ========================== feedback page [end] =========================

    public function main_faculty_dashboard()
    {
        $faculty_session = Session::get('faculty_session');
        return view('main_faculty_dashboard', ['faculty_session' => $faculty_session]);
    }

    public function main_faculty_dashboard_show_all_tutorials_page()
    {
        $all_tutorial_types = tutorial_types_table::all();
        $faculty_session = Session::get('faculty_session');
        return view('main_faculty_dashboard_show_all_tutorials_page', compact('faculty_session', 'all_tutorial_types'));
    }

    public function main_faculty_dashboard_add_new_tutorial_page()
    {
        $all_tutorial_types = tutorial_types_table::all();
        $faculty_session = Session::get('faculty_session');
        return view('main_faculty_dashboard_add_new_tutorial_page', compact('faculty_session', 'all_tutorial_types'));
    }

    public function main_faculty_dashboard_update_tutorial_page_with_alert()
    {
        return redirect()->route('main_faculty_dashboard_show_all_tutorials_page')->with('alert', 'In order to access the update page, please select any item for update operation From the All Tutorials');
    }

    public function main_faculty_dashboard_show_all_playlists_page()
    {
        $faculty_session = Session::get('faculty_session');
        return view('main_faculty_dashboard_show_all_playlists_page', ['faculty_session' => $faculty_session]);
    }

    public function main_faculty_dashboard_add_new_playlist_page()
    {
        $faculty_session = Session::get('faculty_session');
        return view('main_faculty_dashboard_add_new_playlist_page', ['faculty_session' => $faculty_session]);
    }

    public function main_faculty_dashboard_update_playlist_page()
    {
        $faculty_session = Session::get('faculty_session');
        return view('main_faculty_dashboard_update_playlist_page', ['faculty_session' => $faculty_session]);
    }

    public function main_faculty_dashboard_show_all_exams_page()
    {
        $faculty_session = Session::get('faculty_session');
        return view('main_faculty_dashboard_show_all_exams_page', ['faculty_session' => $faculty_session]);
    }

    public function main_faculty_dashboard_add_new_exam_page()
    {
        $faculty_session = Session::get('faculty_session');
        return view('main_faculty_dashboard_add_new_exam_page', ['faculty_session' => $faculty_session]);
    }

    public function main_faculty_dashboard_update_exam_page()
    {
        $faculty_session = Session::get('faculty_session');
        return view('main_faculty_dashboard_update_exam_page', ['faculty_session' => $faculty_session]);
    }

    public function main_faculty_dashboard_show_payment_notifications_page()
    {
        $faculty_session = Session::get('faculty_session');
        return view('main_faculty_dashboard_show_payment_notifications_page', ['faculty_session' => $faculty_session]);
    }

    public function main_faculty_dashboard_show_income_page()
    {
        $faculty_session = Session::get('faculty_session');
        return view('main_faculty_dashboard_show_income_page', ['faculty_session' => $faculty_session]);
    }

    public function main_faculty_dashboard_show_total_of_subscribers_page()
    {
        $faculty_session = Session::get('faculty_session');
        return view('main_faculty_dashboard_show_total_of_subscribers_page', ['faculty_session' => $faculty_session]);
    }

    public function main_faculty_dashboard_show_student_notification_page()
    {
        $faculty_session = Session::get('faculty_session');
        return view('main_faculty_dashboard_show_student_notification_page', ['faculty_session' => $faculty_session]);
    }

    public function main_faculty_dashboard_show_admin_notification_page()
    {
        $faculty_session = Session::get('faculty_session');
        return view('main_faculty_dashboard_show_admin_notification_page', ['faculty_session' => $faculty_session]);
    }

    public function main_faculty_dashboard_show_student_feedback_page()
    {
        $faculty_session = Session::get('faculty_session');
        return view('main_faculty_dashboard_show_student_feedback_page', ['faculty_session' => $faculty_session]);
    }

    public function main_faculty_dashboard_student_communication_by_mail_page()
    {
        $faculty_session = Session::get('faculty_session');
        return view('main_faculty_dashboard_student_communication_by_mail_page', ['faculty_session' => $faculty_session]);
    }

    public function main_faculty_dashboard_admin_communication_by_mail_page()
    {
        $faculty_session = Session::get('faculty_session');
        return view('main_faculty_dashboard_admin_communication_by_mail_page', ['faculty_session' => $faculty_session]);
    }

    public function main_faculty_dashboard_settings_page()
    {
        $faculty_session = Session::get('faculty_session');
        return view('main_faculty_dashboard_settings_page', ['faculty_session' => $faculty_session]);
    }

    public function main_faculty_dashboard_help_page()
    {
        $faculty_session = Session::get('faculty_session');
        return view('main_faculty_dashboard_help_page', ['faculty_session' => $faculty_session]);
    }

    public function main_faculty_dashboard_about_us_page()
    {
        $faculty_session = Session::get('faculty_session');
        return view('main_faculty_dashboard_about_us_page', ['faculty_session' => $faculty_session]);
    }

    public function main_faculty_dashboard_contact_us_page()
    {
        $faculty_session = Session::get('faculty_session');
        return view('main_faculty_dashboard_contact_us_page', ['faculty_session' => $faculty_session]);
    }

    public function main_faculty_dashboard_documentation_page()
    {
        $faculty_session = Session::get('faculty_session');
        return view('main_faculty_dashboard_documentation_page', ['faculty_session' => $faculty_session]);
    }

    public function main_faculty_dashboard_profile_page()
    {
        $faculty_session = Session::get('faculty_session');
        return view('main_faculty_dashboard_profile_page', ['faculty_session' => $faculty_session]);
    }

    public function main_faculty_dashboard_customization_page()
    {
        $faculty_session = Session::get('faculty_session');
        return view('main_faculty_dashboard_customization_page', ['faculty_session' => $faculty_session]);
    }

    public function form_for_video_type_tutorial(){
        $all_languages = languages_info_table::all();
        $all_courses = Courses_info_table::all();
        $all_subjects = subjects_info_table::all();
        $faculty_session = Session::get('faculty_session');
        return view('form_for_video_type_tutorial', compact('faculty_session', 'all_languages', 'all_courses', 'all_subjects'));
    }

    public function form_for_pdf_type_tutorial(){
        $all_languages = languages_info_table::all();
        $all_courses = Courses_info_table::all();
        $all_subjects = subjects_info_table::all();
        $faculty_session = Session::get('faculty_session');
        return view('form_for_pdf_type_tutorial', compact('faculty_session', 'all_languages', 'all_courses', 'all_subjects'));
    }

    public function video_pdf_form_switching_route(Request $request){

        $selectedTutorialType = $request->input('tutorial_type');

        if ($selectedTutorialType === 'PDF')
        {
            return redirect()->route('form_for_pdf_type_tutorial');
        }elseif($selectedTutorialType === 'Video')
        {
            return redirect()->route('form_for_video_type_tutorial');
        }
    }

    // public function form_for_video_type_tutorial_submission_route(Request $request){
    //     echo "Hello from form_for_video_type_tutorial_submission_route";

    //     try {
    //         $validatedData = $request->validate([
    //             'video_tutorial_url' => 'required|file|mimetypes:video/mp4',
    //             'video_tutorial_Thumbnail_Image' => 'required|image|mimes:jpeg,png,jpg',
    //             'video_tutorial_title' => 'required|string',
    //             'video_tutorial_description' => 'required|string',
    //             'video_tutorial_selected_Language' => 'required|string',
    //             'video_tutorial_keywords_or_tags' => 'required|string',
    //             'video_tutorial_selected_course_name' => 'required|string',
    //             'video_tutorial_selected_subject_name' => 'required|string',
    //         ], [
    //             'video_tutorial_title.required' => 'Please enter Video Title.',
    //         ]);
    //     } catch (\Illuminate\Validation\ValidationException $e) {
    //         $errorMessages = $e->validator->getMessageBag()->all();

    //         // Display error messages using JavaScript alerts
    //         echo '<script>';
    //         foreach ($errorMessages as $errorMessage) {
    //             echo 'alert("' . $errorMessage . '");';
    //         }
    //         echo '</script>';
    //         return;
    //     }

    //     $video_tutorial_selected_Language = languages_info_table::where('language_name', $validatedData['video_tutorial_selected_Language'])->first();
    //     $video_tutorial_selected_course = Courses_info_table::where('course_name', $validatedData['video_tutorial_selected_course_name'])->first();
    //     $video_tutorial_selected_subject = subjects_info_table::where('subject_name', $validatedData['video_tutorial_selected_subject_name'])->first();

    //     if (!$video_tutorial_selected_Language) {
    //         return redirect()->back()->with('add_video_tuts_route_msg', 'Selected Language not found.');
    //     }

    //     if (!$video_tutorial_selected_course) {
    //         return redirect()->back()->with('add_video_tuts_route_msg', 'Selected Course not found.');
    //     }

    //     if (!$video_tutorial_selected_subject) {
    //         return redirect()->back()->with('add_video_tuts_route_msg', 'Selected Subject not found.');
    //     }

    //     // $video_tutorial_url = $request->file('video_tutorial_url')->store('video_tutorials', 'public');

    //     // ==================================================
    //     $videoPath = $request->file('video_tutorial_url')->store('video_tutorials', 'public');
    //     $getID3 = new getID3();
    //     $fileInfo = $getID3->analyze(storage_path('app/public/' . $videoPath));
    //     $durationInSeconds = $fileInfo['playtime_seconds'];
    //     $formattedDuration = gmdate('H:i:s', $durationInSeconds);

        

    //     // ================================================

    //     // $video_size = $video_tutorial_url->getSize();
    //     // $video_size_kb = round($video_size / 1024);
    //     // $video_size_mb = round($video_size / 1048576);
    //     // $video_size_gb = round($video_size / 1073741824);
    //     // $video_tutorial_file_size_with_mb = $video_size_mb . "MB";

    //     $video_tutorial_Thumbnail_Image = $request->file('video_tutorial_Thumbnail_Image')->store('video_tutorial_Thumbnail_Image', 'public');

    //     $faculty_session = Session::get('faculty_session');
    //     $faculty_id = $faculty_session->id;

    //     $videoTutorialDone = video_tutorials_info_table::create([
    //         'faculty_id' => $faculty_id,
    //         'video_tutorial_url' => $video_tutorial_url,
    //         'video_tutorial_Thumbnail_Image' => $video_tutorial_Thumbnail_Image,
    //         'video_tutorial_title' => $request->input('video_tutorial_title'),
    //         'video_tutorial_description' => $request->input('video_tutorial_description'),
    //         'video_tutorial_selected_Language_id' => $video_tutorial_selected_Language->id,
    //         'video_tutorial_selected_Language' => $request->input('video_tutorial_selected_Language'),
    //         'video_tutorial_keywords_or_tags' => $request->input('video_tutorial_keywords_or_tags'),
    //         'video_tutorial_selected_course_id' => $video_tutorial_selected_course->id,
    //         'video_tutorial_selected_course_name' => $request->input('video_tutorial_selected_course_name'),
    //         'video_tutorial_selected_subject_id' => $video_tutorial_selected_subject->id,
    //         'video_tutorial_selected_subject_name' => $request->input('video_tutorial_selected_subject_name'),
    //         'video_tutorial_status' => 'active', 
    //         'video_tutorial_Duration_in_time' => $formattedDuration,
    //         'video_tutorial_file_size' => $video_tutorial_file_size_with_mb,
    //         'tc' => true,
    //     ]);

    //     if ($videoTutorialDone) {
    //         return redirect()->back()->with('add_video_tuts_route_msg', 'Video Added Successfully...!');
    //     } else {
    //         echo "Error occurred in data insertion";
    //     }
    // }

    public function form_for_video_type_tutorial_submission_route(Request $request)
    {
        echo "Hello from form_for_video_type_tutorial_submission_route";

        try {
            $validatedData = $request->validate([
                'video_tutorial_url' => 'required|file|mimetypes:video/mp4',
                'video_tutorial_Thumbnail_Image' => 'required|image|mimes:jpeg,png,jpg',
                'video_tutorial_title' => 'required|string',
                'video_tutorial_description' => 'required|string',
                'video_tutorial_selected_Language' => 'required|string',
                'video_tutorial_keywords_or_tags' => 'required|string',
                'video_tutorial_selected_course_name' => 'required|string',
                'video_tutorial_selected_subject_name' => 'required|string',
            ], [
                'video_tutorial_title.required' => 'Please enter Video Title.',
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

        $video_tutorial_selected_Language = languages_info_table::where('language_name', $validatedData['video_tutorial_selected_Language'])->first();
        $video_tutorial_selected_course = Courses_info_table::where('course_name', $validatedData['video_tutorial_selected_course_name'])->first();
        $video_tutorial_selected_subject = subjects_info_table::where('subject_name', $validatedData['video_tutorial_selected_subject_name'])->first();

        if (!$video_tutorial_selected_Language) {
            return redirect()->back()->with('add_video_tuts_route_msg', 'Selected Language not found.');
        }

        if (!$video_tutorial_selected_course) {
            return redirect()->back()->with('add_video_tuts_route_msg', 'Selected Course not found.');
        }

        if (!$video_tutorial_selected_subject) {
            return redirect()->back()->with('add_video_tuts_route_msg', 'Selected Subject not found.');
        }

        $videoPath = $request->file('video_tutorial_url')->store('video_tutorials', 'public');
        $getID3 = new getID3();
        $fileInfo = $getID3->analyze(storage_path('app/public/' . $videoPath));
        $durationInSeconds = $fileInfo['playtime_seconds'];
        $formattedDuration = gmdate('H:i:s', $durationInSeconds);

        $video_tutorial_Thumbnail_Image = $request->file('video_tutorial_Thumbnail_Image')->store('video_tutorial_Thumbnail_Image', 'public');

        $faculty_session = Session::get('faculty_session');
        $faculty_id = $faculty_session->id;

        $video_tutorial_file_size_with_mb = round($request->file('video_tutorial_url')->getSize() / 1048576) . "MB";

        $videoTutorialDone = video_tutorials_info_table::create([
            'faculty_id' => $faculty_id,
            'video_tutorial_url' => $videoPath,
            'video_tutorial_Thumbnail_Image' => $video_tutorial_Thumbnail_Image,
            'video_tutorial_title' => $request->input('video_tutorial_title'),
            'video_tutorial_description' => $request->input('video_tutorial_description'),
            'video_tutorial_selected_Language_id' => $video_tutorial_selected_Language->id,
            'video_tutorial_selected_Language' => $request->input('video_tutorial_selected_Language'),
            'video_tutorial_keywords_or_tags' => $request->input('video_tutorial_keywords_or_tags'),
            'video_tutorial_selected_course_id' => $video_tutorial_selected_course->id,
            'video_tutorial_selected_course_name' => $request->input('video_tutorial_selected_course_name'),
            'video_tutorial_selected_subject_id' => $video_tutorial_selected_subject->id,
            'video_tutorial_selected_subject_name' => $request->input('video_tutorial_selected_subject_name'),
            'video_tutorial_status' => 'active',
            'video_tutorial_Duration_in_time' => $formattedDuration,
            'video_tutorial_file_size' => $video_tutorial_file_size_with_mb,
            'tc' => true,
        ]);

        if ($videoTutorialDone) {
            return redirect()->back()->with('add_video_tuts_route_msg', 'Video Added Successfully...!');
        } else {
            echo "Error occurred in data insertion";
        }
    }

    public function form_for_pdf_type_tutorial_submission_route(Request $request)
    {
        echo "Hello from form_for_pdf_type_tutorial_submission_route";

        try {
            $validatedData = $request->validate([
                'PDF_tutorial_path' => 'required|file|mimetypes:application/pdf',
                'PDF_tutorial_Thumbnail_Image' => 'required|image|mimes:jpeg,png,jpg',
                'PDF_tutorial_title' => 'required|string',
                'PDF_tutorial_description' => 'required|string',
                'PDF_tutorial_selected_Language' => 'required|string',
                'PDF_tutorial_keywords_or_tags' => 'required|string',
                'PDF_tutorial_selected_course_name' => 'required|string',
                'PDF_tutorial_selected_subject_name' => 'required|string',
            ], [
                'PDF_tutorial_title.required' => 'Please enter PDF Title.',
            ]);

            // Get selected language, course, and subject
            $PDF_tutorial_selected_Language = languages_info_table::where('language_name', $validatedData['PDF_tutorial_selected_Language'])->first();
            $PDF_tutorial_selected_course = Courses_info_table::where('course_name', $validatedData['PDF_tutorial_selected_course_name'])->first();
            $PDF_tutorial_selected_subject = subjects_info_table::where('subject_name', $validatedData['PDF_tutorial_selected_subject_name'])->first();

            // Check if language, course, and subject exist
            if (!$PDF_tutorial_selected_Language) {
                return redirect()->back()->with('add_pdf_tuts_route_msg', 'Selected Language not found.');
            }

            if (!$PDF_tutorial_selected_course) {
                return redirect()->back()->with('add_pdf_tuts_route_msg', 'Selected Course not found.');
            }

            if (!$PDF_tutorial_selected_subject) {
                return redirect()->back()->with('add_pdf_tuts_route_msg', 'Selected Subject not found.');
            }

            // Store PDF file and get path
            $PDFPath = $request->file('PDF_tutorial_path')->store('pdf_tutorials', 'public');

           // Get the total number of pages in the PDF
            $totalPages = $this->getPdfPageCount(storage_path('app/public/' . $PDFPath));

            // Store Thumbnail Image
            $PDF_tutorial_Thumbnail_Image = $request->file('PDF_tutorial_Thumbnail_Image')->store('pdf_tutorial_Thumbnail_Image', 'public');

            // Get faculty information
            $faculty_session = Session::get('faculty_session');
            $faculty_id = $faculty_session->id;

            // Calculate PDF file size
            $PDF_tutorial_file_size_with_mb = round($request->file('PDF_tutorial_path')->getSize() / 1048576) . "MB";

            // Create PDF Tutorial record
            $PDFTutorialDone = pdf_tutorials_info_table::create([
                'faculty_id' => $faculty_id,
                'PDF_tutorial_path' => $PDFPath,
                'PDF_tutorial_Thumbnail_Image' => $PDF_tutorial_Thumbnail_Image,
                'PDF_tutorial_title' => $request->input('PDF_tutorial_title'),
                'PDF_tutorial_description' => $request->input('PDF_tutorial_description'),
                'PDF_tutorial_selected_Language_id' => $PDF_tutorial_selected_Language->id,
                'PDF_tutorial_selected_Language' => $request->input('PDF_tutorial_selected_Language'),
                'PDF_tutorial_keywords_or_tags' => $request->input('PDF_tutorial_keywords_or_tags'),
                'PDF_tutorial_selected_course_id' => $PDF_tutorial_selected_course->id,
                'PDF_tutorial_selected_course_name' => $request->input('PDF_tutorial_selected_course_name'),
                'PDF_tutorial_selected_subject_id' => $PDF_tutorial_selected_subject->id,
                'PDF_tutorial_selected_subject_name' => $request->input('PDF_tutorial_selected_subject_name'),
                'PDF_tutorial_status' => 'active',
                'PDF_tutorial_page_numbers' => $totalPages,
                'PDF_tutorial_file_size' => $PDF_tutorial_file_size_with_mb,
                'tc' => true,
            ]);

            if ($PDFTutorialDone) {
                return redirect()->back()->with('add_pdf_tuts_route_msg', 'PDF Added Successfully...!');
            } else {
                echo "Error occurred in data insertion";
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        }
    }

    public function view_of_faculty_for_pdf_type_tutorial()
    {
        $faculty_session = Session::get('faculty_session');
        $facultyId = $faculty_session['id'];
        $particular_faculty_all_pdf_tutorials = pdf_tutorials_info_table::where('faculty_id', $facultyId)->get();
        return view('view_of_faculty_for_pdf_type_tutorial', ['faculty_session' => $faculty_session, 'particular_faculty_all_pdf_tutorials' => $particular_faculty_all_pdf_tutorials]);
    }

    public function view_of_faculty_for_video_type_tutorial()
    {
        $faculty_session = Session::get('faculty_session');
        $facultyId = $faculty_session['id'];
        $particular_faculty_all_video_tutorials = video_tutorials_info_table::where('faculty_id', $facultyId)->get();
        return view('view_of_faculty_for_video_type_tutorial', ['faculty_session' => $faculty_session, 'particular_faculty_all_video_tutorials' => $particular_faculty_all_video_tutorials]);
    }

    public function video_pdf_show_tutorials_switching_route(Request $request){

        $selectedTutorialType = $request->input('tutorial_type');

        if ($selectedTutorialType === 'PDF')
        {
            return redirect()->route('view_of_faculty_for_pdf_type_tutorial');
        }elseif($selectedTutorialType === 'Video')
        {
            return redirect()->route('view_of_faculty_for_video_type_tutorial');
        }
    }

    public function deleting_video_tutorial_from_faculty($id){
        $video_tutorial_to_delete_from_faculty = video_tutorials_info_table::find($id);
        $video_tutorial_to_delete_from_faculty->delete();
        return redirect()->back()->with('delete_video_tutorial_from_faculty_route_msg', 'Video Deleted Successfully...!');
    }

    public function deleting_pdf_tutorial_from_faculty($id){
        $pdf_tutorial_to_delete_from_faculty = pdf_tutorials_info_table::find($id);
        $pdf_tutorial_to_delete_from_faculty->delete();
        return redirect()->back()->with('delete_pdf_tutorial_from_faculty_route_msg', 'PDF Deleted Successfully...!');
    }

    public function updating_video_tutorial_from_faculty_page($id){
        $video_tutorial_to_update_from_faculty = video_tutorials_info_table::find($id);
        $all_languages = languages_info_table::all();
        $all_courses = Courses_info_table::all();
        $all_subjects = subjects_info_table::all();
        $faculty_session = Session::get('faculty_session');
        return view('updating_video_tutorial_from_faculty_page', compact('faculty_session', 'all_languages', 'all_courses', 'all_subjects', 'video_tutorial_to_update_from_faculty'));
    }

    public function show_current_video_to_faculty_for_update_video_tutorial_page($id, $video_tutorial_id){
        $current_video_to_show = video_tutorials_info_table::find($video_tutorial_id);
        $faculty_session = Session::get('faculty_session');
        return view('show_current_video_to_faculty_for_update_video_tutorial_page', compact('faculty_session', 'current_video_to_show'));
    }

    public function show_Current_Thumbnail_Images_to_faculty_for_update_video_tutorial_page($id, $video_tutorial_id){
        $current_tumbnail_image_to_show = video_tutorials_info_table::find($video_tutorial_id);
        $faculty_session = Session::get('faculty_session');
        return view('show_Current_Thumbnail_Images_to_faculty_for_update_video_tutorial_page', compact('faculty_session', 'current_tumbnail_image_to_show'));
    }

    public function updating_video_tutorial_from_faculty_page_form_submission(Request $request, $id)
    { 

        try {
            $validatedData = $request->validate([
                'video_tutorial_url' => 'nullable|file|mimetypes:video/mp4',
                'video_tutorial_Thumbnail_Image' => 'nullable|image|mimes:jpeg,png,jpg',
                'video_tutorial_title' => 'required|string',
                'video_tutorial_description' => 'required|string',
                'video_tutorial_selected_Language' => 'required|string',
                'video_tutorial_keywords_or_tags' => 'required|string',
                'video_tutorial_selected_course_name' => 'required|string',
                'video_tutorial_selected_subject_name' => 'required|string',
            ], [
                'video_tutorial_title.required' => 'Please enter Video Title.',
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

        // Fetch the video tutorial to update
        $videoTutorialToUpdate = video_tutorials_info_table::find($id);

        // Check if the user wants to update the video tutorial URL
        if ($request->hasFile('video_tutorial_url')) {
            // Delete the old file
            Storage::disk('public')->delete($videoTutorialToUpdate->video_tutorial_url);

            // Update the video tutorial URL
            $videoPath = $request->file('video_tutorial_url')->store('video_tutorials', 'public');
            $videoTutorialToUpdate->video_tutorial_url = $videoPath;
        }

        // Check if the user wants to update the thumbnail image
        if ($request->hasFile('video_tutorial_Thumbnail_Image')) {
            // Delete the old file
            Storage::disk('public')->delete($videoTutorialToUpdate->video_tutorial_Thumbnail_Image);

            // Update the thumbnail image
            $video_tutorial_Thumbnail_Image = $request->file('video_tutorial_Thumbnail_Image')->store('video_tutorial_Thumbnail_Image', 'public');
            $videoTutorialToUpdate->video_tutorial_Thumbnail_Image = $video_tutorial_Thumbnail_Image;
        }

        // Update other fields based on your form data
        $videoTutorialToUpdate->video_tutorial_title = $request->input('video_tutorial_title');
        $videoTutorialToUpdate->video_tutorial_description = $request->input('video_tutorial_description');
        $videoTutorialToUpdate->video_tutorial_keywords_or_tags = $request->input('video_tutorial_keywords_or_tags');
        $videoTutorialToUpdate->video_tutorial_selected_Language = $request->input('video_tutorial_selected_Language');
        $videoTutorialToUpdate->video_tutorial_selected_course_name = $request->input('video_tutorial_selected_course_name');
        $videoTutorialToUpdate->video_tutorial_selected_subject_name = $request->input('video_tutorial_selected_subject_name');

        // Update relations
        $video_tutorial_selected_Language = languages_info_table::where('language_name', $validatedData['video_tutorial_selected_Language'])->first();
        $video_tutorial_selected_course = Courses_info_table::where('course_name', $validatedData['video_tutorial_selected_course_name'])->first();
        $video_tutorial_selected_subject = subjects_info_table::where('subject_name', $validatedData['video_tutorial_selected_subject_name'])->first();

        $videoTutorialToUpdate->video_tutorial_selected_Language_id = $video_tutorial_selected_Language->id;
        $videoTutorialToUpdate->video_tutorial_selected_course_id = $video_tutorial_selected_course->id;
        $videoTutorialToUpdate->video_tutorial_selected_subject_id = $video_tutorial_selected_subject->id;

        // Save the changes
        $videoTutorialToUpdate->save();

        return redirect()->back()->with('update_video_tutorial_msg', 'Changes Saved Successfully!');
    }

    public function updating_pdf_tutorial_from_faculty_page($id){
        $pdf_tutorial_to_update_from_faculty = pdf_tutorials_info_table::find($id);
        $all_languages = languages_info_table::all();
        $all_courses = Courses_info_table::all();
        $all_subjects = subjects_info_table::all();
        $faculty_session = Session::get('faculty_session');
        return view('updating_pdf_tutorial_from_faculty_page', compact('faculty_session', 'all_languages', 'all_courses', 'all_subjects', 'pdf_tutorial_to_update_from_faculty'));
    }

    public function show_current_pdf_to_faculty_for_update_pdf_tutorial_page($id, $pdf_tutorial_id){
        $current_pdf_to_show = pdf_tutorials_info_table::find($id);
        return view('show_current_pdf_to_faculty_for_update_pdf_tutorial_page', compact('current_pdf_to_show'));
    }

    public function show_current_thumbnail_image_to_faculty_for_update_pdf_tutorial_page($id, $pdf_tutorial_id){
        $current_thumbnail_image_to_show = pdf_tutorials_info_table::find($id);
        return view('show_current_thumbnail_image_to_faculty_for_update_pdf_tutorial_page', compact('current_thumbnail_image_to_show'));
    }

    public function updating_pdf_tutorial_from_faculty_page_form_submission(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'PDF_tutorial_path' => 'nullable|file|mimetypes:application/pdf',
                'PDF_tutorial_Thumbnail_Image' => 'nullable|image|mimes:jpeg,png,jpg',
                'PDF_tutorial_title' => 'required|string',
                'PDF_tutorial_description' => 'required|string',
                'PDF_tutorial_selected_Language' => 'required|string',
                'PDF_tutorial_keywords_or_tags' => 'required|string',
                'PDF_tutorial_selected_course_name' => 'required|string',
                'PDF_tutorial_selected_subject_name' => 'required|string',
            ], [
                'PDF_tutorial_title.required' => 'Please enter PDF Tutorial Title.',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errorMessages = $e->validator->getMessageBag()->all();

            echo '<script>';
            foreach ($errorMessages as $errorMessage) {
                echo 'alert("' . $errorMessage . '");';
            }
            echo '</script>';
            return;
        }

        $pdfTutorialToUpdate = pdf_tutorials_info_table::find($id);

        if ($request->hasFile('PDF_tutorial_path')) {
            // Delete the old file
            Storage::disk('public')->delete($pdfTutorialToUpdate->PDF_tutorial_path);

            // Update the PDF tutorial path
            $pdfPath = $request->file('PDF_tutorial_path')->store('pdf_tutorials', 'public');
            $pdfTutorialToUpdate->PDF_tutorial_path = $pdfPath;
        }

        if ($request->hasFile('PDF_tutorial_Thumbnail_Image')) {
            Storage::disk('public')->delete($pdfTutorialToUpdate->PDF_tutorial_Thumbnail_Image);

            $pdf_tutorial_Thumbnail_Image = $request->file('PDF_tutorial_Thumbnail_Image')->store('pdf_tutorial_Thumbnail_Image', 'public');
            $pdfTutorialToUpdate->PDF_tutorial_Thumbnail_Image = $pdf_tutorial_Thumbnail_Image;
        }

        // Update other fields based on your form data
        $pdfTutorialToUpdate->PDF_tutorial_title = $request->input('PDF_tutorial_title');
        $pdfTutorialToUpdate->PDF_tutorial_description = $request->input('PDF_tutorial_description');
        $pdfTutorialToUpdate->PDF_tutorial_keywords_or_tags = $request->input('PDF_tutorial_keywords_or_tags');
        $pdfTutorialToUpdate->PDF_tutorial_selected_Language = $request->input('PDF_tutorial_selected_Language');
        $pdfTutorialToUpdate->PDF_tutorial_selected_course_name = $request->input('PDF_tutorial_selected_course_name');
        $pdfTutorialToUpdate->PDF_tutorial_selected_subject_name = $request->input('PDF_tutorial_selected_subject_name');

        // Update relations
        $pdf_tutorial_selected_Language = languages_info_table::where('language_name', $validatedData['PDF_tutorial_selected_Language'])->first();
        $pdf_tutorial_selected_course = Courses_info_table::where('course_name', $validatedData['PDF_tutorial_selected_course_name'])->first();
        $pdf_tutorial_selected_subject = subjects_info_table::where('subject_name', $validatedData['PDF_tutorial_selected_subject_name'])->first();

        $pdfTutorialToUpdate->PDF_tutorial_selected_Language_id = $pdf_tutorial_selected_Language->id;
        $pdfTutorialToUpdate->PDF_tutorial_selected_course_id = $pdf_tutorial_selected_course->id;
        $pdfTutorialToUpdate->PDF_tutorial_selected_subject_id = $pdf_tutorial_selected_subject->id;

        // Save the changes
        $pdfTutorialToUpdate->save();

        return redirect()->back()->with('update_pdf_tutorial_msg', 'Changes Saved Successfully!');
    }

    public function main_faculty_dashboard_nothing_to_show_in_video_type_tutorial(){
        $faculty_session = Session::get('faculty_session');
        return view('main_faculty_dashboard_nothing_to_show_in_video_type_tutorial', compact('faculty_session'));
    }

    public function main_faculty_dashboard_nothing_to_show_in_pdf_type_tutorial(){
        $faculty_session = Session::get('faculty_session');
        return view('main_faculty_dashboard_nothing_to_show_in_pdf_type_tutorial', compact('faculty_session'));
    }


}
