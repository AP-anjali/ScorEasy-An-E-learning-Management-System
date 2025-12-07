<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\students_info_table;
use App\Models\student_otp_table;
use App\Models\faculties_info_table;
use App\Models\faculty_otp_table;
use App\Models\Courses_info_table;
use App\Models\subjects_info_table;
use App\Models\old_question_papers_table;
use App\Models\languages_info_table;
use App\Models\tutorial_types_table;
use App\Models\video_tutorials_info_table;
use App\Models\hero_image;
use App\Models\pdf_tutorials_info_table;
use App\Models\subscriptions_table;
use App\Models\admin_administration_table;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

use App\Mail\AdminVerificationMail;
use App\Models\admin_email_verification_table;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

use Illuminate\Http\Request;

class MainAdminController extends Controller
{

    public function admin_account($admin_id)
    {
        $admin_data = admin_administration_table::find($admin_id);
        return view('showing_logged_in_admin_account', compact('admin_data'));
    }

    public function updating_admin_user_record_from_admin_page_form_submission(Request $request, $id){
        $admin_record_to_update = admin_administration_table::find($id);

        try {
            $validatedData = $request->validate([
                'admin_name' => 'required|string',
                'admin_email' => 'required|email|unique:system_administration,admin_email,' . $id,
                'admin_phone_no' => 'required|string|unique:system_administration,admin_phone_no,' . $id,
                'admin_address' => 'required|string',
                'username' => 'required|string|unique:system_administration,username,' . $id,
                'secret_password' => 'nullable|string',
                'password' => 'required|string',
                'profile_pic' => 'image|mimes:jpeg,png,jpg',
            ], [
                'name.required' => 'Please enter your name',
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

        $admin_record_to_update->admin_name = $request->input('admin_name');
        $admin_record_to_update->admin_email = $request->input('admin_email');
        $admin_record_to_update->admin_phone_no = $request->input('admin_phone_no');
        $admin_record_to_update->admin_address = $request->input('admin_address');
        $admin_record_to_update->username = $request->input('username');
        
        if ($request->filled('password')) {
            $admin_record_to_update->secret_password = bcrypt($request->input('password'));
            $admin_record_to_update->password = $request->input('password'); 
        }

        if ($request->hasFile('profile_pic')) {
            $fileNameWithExt = $request->file('profile_pic')->getClientOriginalName();
            
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            
            $extension = $request->file('profile_pic')->getClientOriginalExtension();
            
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
    
            $path = $request->file('profile_pic')->storeAs('public/img', $fileNameToStore);
    
            $admin_record_to_update->profile_pic = 'img/'.$fileNameToStore;
        }
    
        $admin_record_to_update->save();

        Session::forget('admin_session');
        Session::put('admin_session', $admin_record_to_update);

        return redirect()->back()->with('admin_record_to_update', 'Account updated successfully !');

    }

    public function sending_email_for_verify_admin_user($admin_id)
    {
        $admin_to_sent_an_email = admin_administration_table::find($admin_id);

        $userVerificationCode = admin_email_verification_table::where('admin_id',$admin_to_sent_an_email->id)->latest('varification_code_created_at')->first();

        $now = now();

        if($userVerificationCode && $now->isBefore($userVerificationCode->varification_code_expires_at))
        {
            $verification_code = $userVerificationCode->varification_code;
        }
        else
        {
            $verification_code = Str::random(26);
        }

        $this->sendVerificationCodeEmailToAdmin($admin_to_sent_an_email->admin_email, $verification_code);
        
        admin_email_verification_table::updateOrCreate(['admin_id'=>$admin_to_sent_an_email->id],[
            'admin_id' => $admin_to_sent_an_email->id,
            'varification_code' => $verification_code,
            'varification_code_expires_at' => $now->addMinutes(10)
        ]);

        Session::put('mail_has_been_sent_to_user', true);

        return redirect()->back();
    }

    private function sendVerificationCodeEmailToAdmin($email, $verification_code)
    {
        Mail::to($email)->send(new AdminVerificationMail($verification_code));
    }

    public function verifying_admin_email_verification_code_form_submission($admin_id, Request $request)
    {
        try {
            $validatedData = $request->validate([
                'varification_code' => 'required',
            ],
            [
                'varification_code.required' => 'Please provide the varification code',
            ]);

            $verification_code = admin_email_verification_table::where('admin_id', $admin_id)->where('varification_code', $request->varification_code)->first();

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

            $user = admin_administration_table::whereId($admin_id)->first();

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

    public function deleting_admin_account_from_admin($id){
        $admin_to_delete = admin_administration_table::find($id);
        $admin_to_delete->delete();
        Session::forget('admin_session');
        return redirect('/');
    }

    public function pdf_viewer($id)
    {
        $pdfTutorial = pdf_tutorials_info_table::find($id); 
        return view('pdf_viewer', ['pdfTutorial' => $pdfTutorial]);
    }

    public function document_viewer($id)
    {
        $facultyBankAccountProof = faculties_info_table::find($id); 
        return view('document_viewer', ['facultyBankAccountProof' => $facultyBankAccountProof]);
    }

    public function hero_image_viewer($id)
    {
        $heroImage = hero_image::find($id); 
        return view('hero_image_viewer', ['heroImage' => $heroImage]);
    }

    // public function PDFs_viewer($filename)
    // {
    //     $pdfTutorial = pdf_tutorials_info_table::find($filename); 
    //     return view('PDFs_viewer', ['pdfTutorial' => $pdfTutorial]);
    // }

    public function main_admin_dashboard_show_students_page(){
        $all_students = students_info_table::all();
        $admin_session = Session::get('admin_session');
        return view('main_admin_dashboard_show_students_page', compact('admin_session', 'all_students'));
    }

    public function main_admin_dashboard_show_faculties_page(){
        $all_faculties = faculties_info_table::all();
        $admin_session = Session::get('admin_session');
        return view('main_admin_dashboard_show_faculties_page', compact('admin_session', 'all_faculties'));
    }

    public function main_admin_dashboard_show_tutorials_page(){
        $all_tutorial_types = tutorial_types_table::all();
        $admin_session = Session::get('admin_session');
        return view('main_admin_dashboard_show_tutorials_page', compact('admin_session', 'all_tutorial_types'));
    }

    public function main_admin_dashboard_show_courses_page(){
        $all_courses = Courses_info_table::all();
        $admin_session = Session::get('admin_session');
        return view('main_admin_dashboard_show_courses_page', ['admin_session' => $admin_session], compact('all_courses'));
    }

    public function main_admin_dashboard_add_new_course_page(){
        $admin_session = Session::get('admin_session');
        return view('main_admin_dashboard_add_new_course_page', ['admin_session' => $admin_session]);
    }

    public function main_admin_dashboard_update_course_page($id){
        $course_to_update = Courses_info_table::find($id);
        $admin_session = Session::get('admin_session');
        return view('main_admin_dashboard_update_course_page', compact('admin_session', 'course_to_update'));
    }

    public function main_admin_dashboard_show_courses_page_with_alert(){
        return redirect()->route('main_admin_dashboard_show_courses_page')->with('alert', 'In order to access the update page, please select any item for update operation From the All Courses');
    }

    public function updating_new_course(Request $request, $id){
        $course_to_update = Courses_info_table::find($id);

        $course_to_update->course_name = $request->course_name;

        $course_to_update->save();

        return redirect()->back()->with('message', 'Changes Saved Successfully...!');
    }

    // ================================
    public function main_admin_dashboard_show_subjects_page(){
        $all_subjects = subjects_info_table::all();
        $admin_session = Session::get('admin_session');
        return view('main_admin_dashboard_show_subjects_page', compact('admin_session', 'all_subjects'));
    }

    public function main_admin_dashboard_show_subjects_page_with_alert(){
        return redirect()->route('main_admin_dashboard_show_subjects_page')->with('alert', 'In order to access the update page, please select any item for update operation From the All Subjects');
    }

    public function main_admin_dashboard_add_new_subject_page(){
        $all_courses = Courses_info_table::all();
        $admin_session = Session::get('admin_session');
        return view('main_admin_dashboard_add_new_subject_page',compact('admin_session', 'all_courses'));
    }

    public function main_admin_dashboard_update_subject_page($id){
        $subject_to_update = subjects_info_table::find($id);
        $all_courses = Courses_info_table::all();
        $admin_session = Session::get('admin_session');
        return view('main_admin_dashboard_update_subject_page', compact('admin_session', 'subject_to_update', 'all_courses'));
    }

    public function updating_new_subject(Request $request, $id){
        $subject_to_update = subjects_info_table::find($id);

        $subject_to_update->selected_course_name = $request->selected_course_name;

        $selectedCourse = Courses_info_table::where('course_name', $subject_to_update->selected_course_name )->first();

        if ($selectedCourse) {
            $subject_to_update->selected_course_id = $selectedCourse->id;
        }

        $subject_to_update->subject_name = $request->subject_name;
        $subject_to_update->subject_description = $request->subject_description;

        $subject_to_update->save();

        return redirect()->back()->with('message', 'Changes Saved Successfully...!');
    }

    public function main_admin_dashboard_show_languages_page(){
        $all_languages = languages_info_table::all();
        $admin_session = Session::get('admin_session');
        return view('main_admin_dashboard_show_languages_page', compact('admin_session', 'all_languages'));
    }

    public function main_admin_dashboard_add_new_language_page(){
        $admin_session = Session::get('admin_session');
        return view('main_admin_dashboard_add_new_language_page', ['admin_session' => $admin_session]);
    }

    public function main_admin_dashboard_update_language_page($id){
        $language_to_update = languages_info_table::find($id);
        $admin_session = Session::get('admin_session');
        return view('main_admin_dashboard_update_language_page', compact('admin_session', 'language_to_update'));
    }

    public function main_admin_dashboard_show_languages_page_with_alert(){
        return redirect()->route('main_admin_dashboard_show_languages_page')->with('alert', 'In order to access the update page, please select any item for update operation From the All Languages');
    }

    public function updating_new_language(Request $request, $id){
        $language_to_update = languages_info_table::find($id);

        $language_to_update->language_name = $request->language_name;

        $language_to_update->save();

        return redirect()->back()->with('message', 'Changes Saved Successfully...!');
    }

    public function main_admin_dashboard_show_tutorial_types_page(){
        $all_tutorial_types = tutorial_types_table::all();
        $admin_session = Session::get('admin_session');
        return view('main_admin_dashboard_show_tutorial_types_page', compact('admin_session', 'all_tutorial_types'));
    }

    public function main_admin_dashboard_add_new_tutorial_types_page(){
        $admin_session = Session::get('admin_session');
        return view('main_admin_dashboard_add_new_tutorial_types_page', ['admin_session' => $admin_session]);
    }

    public function main_admin_dashboard_update_tutorial_types_page($id){
        $tutorial_type_to_update = tutorial_types_table::find($id);
        $admin_session = Session::get('admin_session');
        return view('main_admin_dashboard_update_tutorial_types_page', compact('admin_session', 'tutorial_type_to_update'));
    }

    public function main_admin_dashboard_show_tutorial_types_page_with_alert(){
        return redirect()->route('main_admin_dashboard_show_tutorial_types_page')->with('alert', 'In order to access the update page, please select any item for update operation From the All Tutorial Types');
    }

    public function updating_new_tutorial_type(Request $request, $id){
        $tutorial_type_to_update = tutorial_types_table::find($id);

        $tutorial_type_to_update->tutorial_type = $request->tutorial_type;

        $tutorial_type_to_update->save();

        return redirect()->back()->with('message', 'Changes Saved Successfully...!');
    }

    // ===================================================
    public function main_admin_dashboard_show_all_old_question_papers_page(){
        $all_old_question_papers = old_question_papers_table::all();
        $admin_session = Session::get('admin_session');
        return view('main_admin_dashboard_show_all_old_question_papers_page', compact('admin_session', 'all_old_question_papers'));
    }
    public function main_admin_dashboard_add_new_old_question_paper_page(){
        $all_courses = Courses_info_table::all();
        $admin_session = Session::get('admin_session');
        return view('main_admin_dashboard_add_new_old_question_paper_page', compact('admin_session', 'all_courses'));
    }
    public function main_admin_dashboard_update_old_question_paper_page($id){
        $Question_paper_to_update = old_question_papers_table::find($id);
        $all_courses = Courses_info_table::all();
        $admin_session = Session::get('admin_session');
        return view('main_admin_dashboard_update_old_question_paper_page', compact('admin_session', 'Question_paper_to_update', 'all_courses'));
    }

    public function adding_new_old_question_paper(Request $request){
        echo "Hello from adding_new_old_question_paper function";

        try {
            $validatedData = $request->validate([
                'selected_course_name' => 'required|string|exists:courses_info,course_name',
                'material' => 'required|file|mimes:pdf',
                'material_Thumbnail_Image' => 'required|file|mimes:png,jpg,jpeg',
                'material_title' => 'required|string',
                'material_description' => 'required|string',
            ], [
                'selected_course_name.required' => 'Please select a course.',
                'material.required' => 'Please upload material.',
                'material_title.required' => 'Please enter the Material Title.',
                'material_description.required' => 'Please enter the Material description.',
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

        $selectedCourse = Courses_info_table::where('course_name', $validatedData['selected_course_name'])->first();

        if (!$selectedCourse) {
            return redirect()->back()->with('add_old_question_paper_route_msg', 'Selected Course not found.');
        }

        $materialFile = $request->file('material');
        $materialPath = $materialFile->store('Old_Question_Papers', 'public');

        $materialThumbnail_Image = $request->file('material_Thumbnail_Image');
        $materialThumbnail_ImagePath = $materialThumbnail_Image->store('Old_Question_Papers_Thumbnail_Images', 'public');

        $admin_session = Session::get('admin_session');
        $admin_id = $admin_session->id;

        $materialDone = old_question_papers_table::create([
            'admin_id' => $admin_id,
            'selected_course_name' => $request->input('selected_course_name'),
            'selected_course_id' => $selectedCourse->id,
            'material' => $materialPath, 
            'material_Thumbnail_Image' => $materialThumbnail_ImagePath, 
            'material_title' => $request->input('material_title'),
            'material_description' => $request->input('material_description'),
        ]);

        if ($materialDone) {
            return redirect()->back()->with('add_old_question_paper_route_msg', 'Question Paper Added Successfully...!');
        } else {
            echo "Error occurred in data insertion";
        }

    }
    public function Old_Question_Paper_Viewer_for_ADMIN($id){
        $Old_Question_Paper_To_Open = old_question_papers_table::find($id); 
        return view('Old_Question_Paper_Viewer_for_ADMIN', ['Old_Question_Paper_To_Open' => $Old_Question_Paper_To_Open]);
    }
    public function Old_Question_Paper_thumbnail_image_Viewer_for_ADMIN($id){
        $Old_Question_Paper_To_Open = old_question_papers_table::find($id); 
        return view('Old_Question_Paper_thumbnail_image_Viewer_for_ADMIN', ['Old_Question_Paper_To_Open' => $Old_Question_Paper_To_Open]);
    }
    public function delete_old_question_paper($id){
        $Question_paper_to_delete = old_question_papers_table::find($id);
        $Question_paper_to_delete->delete();
        return redirect()->back()->with('delete_old_question_paper_route_msg', 'Question Paper Deleted Successfully...!');
    }
    public function main_admin_dashboard_show_all_old_question_papers_with_alert(){
        return redirect()->route('main_admin_dashboard_show_all_old_question_papers_page')->with('alert', 'In order to access the update page, please select any item for update operation From the All Materials');
    }
    public function show_current_old_question_paper_pdf_to_admin_for_update_old_question_paper_page($id, $question_paper_id){
        $current_old_question_pdf_to_show = old_question_papers_table::find($question_paper_id);
        $admin_session = Session::get('admin_session');
        return view('show_current_old_question_paper_pdf_to_admin_for_update_old_question_paper_page', compact('admin_session', 'current_old_question_pdf_to_show'));
    }
    public function show_current_old_question_paper_thumbnail_image_to_admin_for_update_old_question_paper_page($id, $question_paper_id){
        $current_old_question_pdf_to_show = old_question_papers_table::find($question_paper_id);
        $admin_session = Session::get('admin_session');
        return view('show_current_old_question_paper_thumbnail_image_to_admin_for_update_old_question_paper_page', compact('admin_session', 'current_old_question_pdf_to_show'));
    }

    public function updating_old_question_paper(Request $request, $id){
        echo "Hello from updating_old_question_paper function";
    
        try {
            $validatedData = $request->validate([
                'selected_course_name' => 'required|string|exists:courses_info,course_name',
                'material' => 'nullable|file|mimes:pdf',
                'material_Thumbnail_Image' => 'nullable|file|mimes:png,jpg,jpeg',
                'material_title' => 'required|string',
                'material_description' => 'required|string',
            ], [
                'selected_course_name.required' => 'Please select a course.',
                'material.file' => 'Please upload a valid material file.',
                'material.mimes' => 'The material must be a PDF file.',
                'material_title.required' => 'Please enter the Material Title.',
                'material_description.required' => 'Please enter the Material description.',
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
    
        $question_paper_record_to_update = old_question_papers_table::find($id);
    
        $question_paper_record_to_update->selected_course_name = $validatedData['selected_course_name'];

        $selectedCourse = Courses_info_table::where('course_name', $validatedData['selected_course_name'])->first();

        if ($selectedCourse) {
            $question_paper_record_to_update->selected_course_id = $selectedCourse->id;
        }

        $question_paper_record_to_update->material_title = $validatedData['material_title'];
        $question_paper_record_to_update->material_description = $validatedData['material_description'];
    
        if ($request->hasFile('material')) {
            $materialFile = $request->file('material');
            $materialPath = $materialFile->store('Old_Question_Papers', 'public');
            $question_paper_record_to_update->material = $materialPath;
        }

        if ($request->hasFile('material_Thumbnail_Image')) {
            $material_Thumbnail_Image = $request->file('material_Thumbnail_Image');
            $material_Thumbnail_Image_Path = $material_Thumbnail_Image->store('Old_Question_Papers_Thumbnail_Images', 'public');
            $question_paper_record_to_update->material_Thumbnail_Image = $material_Thumbnail_Image_Path;
        }
    
        $question_paper_record_to_update->save();
    
        return redirect()->back()->with('message', 'Changes Saved Successfully...!');
    }
    

    // ===================================================

    // =================================

    public function main_admin_dashboard_show_subscriptions_page(){
        $all_subscription = subscriptions_table::all();
        $admin_session = Session::get('admin_session');
        return view('main_admin_dashboard_show_subscriptions_page', compact('admin_session', 'all_subscription'));
    }

    public function main_admin_dashboard_show_subscriptions_page_preview_page(){
        $admin_session = Session::get('admin_session');
        return view('main_admin_dashboard_show_subscriptions_page_preview_page', compact('admin_session'));
    }

    public function show_current_thumbnail_image_of_subscription_to_admin($id){
        $subscription_to_show = subscriptions_table::find($id);
        $admin_session = Session::get('admin_session');
        return view('show_current_thumbnail_image_of_subscription_to_admin', compact('admin_session', 'subscription_to_show'));
    }

    public function show_current_background_image_of_subscription_to_admin($id){
        $subscription_to_show = subscriptions_table::find($id);
        $admin_session = Session::get('admin_session');
        return view('show_current_background_image_of_subscription_to_admin', compact('admin_session', 'subscription_to_show'));
    }

    public function main_admin_dashboard_add_new_subscription_page(){
        $admin_session = Session::get('admin_session');
        return view('main_admin_dashboard_add_new_subscription_page', ['admin_session' => $admin_session]);
    }

    public function main_admin_dashboard_show_all_subscribers_page(){
        $admin_session = Session::get('admin_session');
        return view('main_admin_dashboard_show_all_subscribers_page', ['admin_session' => $admin_session]);
    }

    public function main_admin_dashboard_show_all_hero_images_page(){
        $all_hero_images = hero_image::all();
        $admin_session = Session::get('admin_session');
        return view('main_admin_dashboard_show_all_hero_images_page', compact('admin_session', 'all_hero_images'));
    }

    public function main_admin_dashboard_add_new_hero_image_page(){
        $admin_session = Session::get('admin_session');
        return view('main_admin_dashboard_add_new_hero_image_page', ['admin_session' => $admin_session]);
    }

    public function adding_new_hero_image(Request $request){
        if(Session()->has('admin_session'))
        {
            $admin_session = Session::get('admin_session');
            $admin_id = $admin_session->id;

            $request->validate([
                'hero_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $image = $request->file('hero_image');

            $imageName = $image->store('website_hero_images', 'public');

            $data = new hero_image;
            $data->admin_id = $admin_id;
            $data->hero_image = $imageName;
            $data->save();
    
            return redirect()->back()->with('message', 'Image Added Successfully...!');
        }else{
            echo "<h1>unauthenticated user... Getout!<h1>";
        }
    }

    public function delete_hero_image($id){
        $hero_image_to_delete = hero_image::find($id);
        $hero_image_to_delete->delete();
        return redirect()->back()->with('message', 'Image Deleted Successfully...!');
    }

    public function main_admin_dashboard_show_notifications_page(){
        $admin_session = Session::get('admin_session');
        return view('main_admin_dashboard_show_notifications_page', ['admin_session' => $admin_session]);
    }

    public function main_admin_dashboard_show_students_feedback_page(){
        $admin_session = Session::get('admin_session');
        return view('main_admin_dashboard_show_students_feedback_page', ['admin_session' => $admin_session]);
    }

    public function main_admin_dashboard_show_faculties_feedback_page(){
        $admin_session = Session::get('admin_session');
        return view('main_admin_dashboard_show_faculties_feedback_page', ['admin_session' => $admin_session]);
    }

    public function main_admin_dashboard_communication_page(){
        $admin_session = Session::get('admin_session');
        return view('main_admin_dashboard_communication_page', ['admin_session' => $admin_session]);
    }

    public function main_admin_dashboard_show_income_page(){
        $admin_session = Session::get('admin_session');
        return view('main_admin_dashboard_show_income_page', ['admin_session' => $admin_session]);
    }

    public function main_admin_dashboard_show_expenses_page(){
        $admin_session = Session::get('admin_session');
        return view('main_admin_dashboard_show_expenses_page', ['admin_session' => $admin_session]);
    }

    public function main_admin_dashboard_show_analytics_page(){
        $admin_session = Session::get('admin_session');
        return view('main_admin_dashboard_show_analytics_page', ['admin_session' => $admin_session]);
    }

    public function main_admin_dashboard_show_settings_page(){
        $admin_session = Session::get('admin_session');
        return view('main_admin_dashboard_show_settings_page', ['admin_session' => $admin_session]);
    }

    public function main_admin_dashboard_customization_page(){
        $admin_session = Session::get('admin_session');
        return view('main_admin_dashboard_customization_page', ['admin_session' => $admin_session]);
    }

    public function main_admin_dashboard_help_page(){
        $admin_session = Session::get('admin_session');
        return view('main_admin_dashboard_help_page', ['admin_session' => $admin_session]);
    }

    public function main_admin_dashboard_documentation_page(){
        $admin_session = Session::get('admin_session');
        return view('main_admin_dashboard_documentation_page', ['admin_session' => $admin_session]);
    }

    // ============================================================================================================================

    public function adding_new_course(Request $request){
        if(Session()->has('admin_session'))
        {
            $admin_session = Session::get('admin_session');
            $admin_id = $admin_session->id;
            $data = new Courses_info_table;
            $data->course_name = $request->course_name;
            $data->admin_id = $admin_id;
            $data->save();
            return redirect()->back()->with('message', 'Course Added Successfully...!');
        }else{
            echo "<h1>unauthenticated user... Getout!<h1>";
        }
    }

    public function delete_course($id){
        $course_to_delete = Courses_info_table::find($id);
        $course_to_delete->delete();
        return redirect()->back()->with('message', 'Course Deleted Successfully...!');
    }

    public function adding_new_subject(Request $request){
        echo "Hello from adding_new_subject function";

        try {
            $validatedData = $request->validate([
                'selected_course_name' => 'required|string|exists:courses_info,course_name',
                'subject_name' => 'required|string',
                'subject_description' => 'required|string',
            ], [
                'selected_course_name.required' => 'Please select a course.',
                'subject_name.required' => 'Please enter the subject name.',
                'subject_description.required' => 'Please enter the subject description.',
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

        $selectedCourse = Courses_info_table::where('course_name', $validatedData['selected_course_name'])->first();

        if (!$selectedCourse) {
            return redirect()->back()->with('add_subject_route_msg', 'Selected Course not found.');
        }

        $admin_session = Session::get('admin_session');
        $admin_id = $admin_session->id;

        $subjectDone = subjects_info_table::create([
            'admin_id' => $admin_id,
            'selected_course_name' => $request->input('selected_course_name'),
            'selected_course_id' => $selectedCourse->id,
            'subject_name' => $request->input('subject_name'),
            'subject_description' => $request->input('subject_description'),
            'tc' => true,
        ]);

        if ($subjectDone) {
            return redirect()->back()->with('add_subject_route_msg', 'Subject Added Successfully...!');
        } else {
            echo "Error occurred in data insertion";
        }

    }

    public function delete_subject($id){
        $subject_to_delete = subjects_info_table::find($id);
        $subject_to_delete->delete();
        return redirect()->back()->with('delete_subject_route_msg', 'Subject Deleted Successfully...!');
    }

    public function adding_new_language(Request $request){
        if(Session()->has('admin_session'))
        {
            $admin_session = Session::get('admin_session');
            $admin_id = $admin_session->id;
            $data = new languages_info_table;
            $data->language_name = $request->language_name;
            $data->admin_id = $admin_id;
            $data->save();
            return redirect()->back()->with('message', 'Language Added Successfully...!');
        }else{
            echo "<h1>unauthenticated user... Getout!<h1>";
        }
    }

    public function delete_language($id){
        $language_to_delete = languages_info_table::find($id);
        $language_to_delete->delete();
        return redirect()->back()->with('message', 'Language Deleted Successfully...!');
    }

    public function adding_new_tutorial_type(Request $request){
        if(Session()->has('admin_session'))
        {
            $admin_session = Session::get('admin_session');
            $admin_id = $admin_session->id;
            $data = new tutorial_types_table;
            $data->tutorial_type = $request->tutorial_type;
            $data->admin_id = $admin_id;
            $data->save();
            return redirect()->back()->with('message', 'Tutorial Type Added Successfully...!');
        }else{
            echo "<h1>unauthenticated user... Getout!<h1>";
        }
    }

    public function delete_tutorial_type($id){
        $tutorial_type_to_delete = tutorial_types_table::find($id);
        $tutorial_type_to_delete->delete();
        return redirect()->back()->with('message', 'Tutorial Type Deleted Successfully...!');
    }

    public function view_of_admin_for_pdf_type_tutorial()
    {
        $admin_session = Session::get('admin_session');
        $admin_id = $admin_session->id;
        $all_pdf_tutorials = pdf_tutorials_info_table::all();
        return view('view_of_admin_for_pdf_type_tutorial', ['admin_session' => $admin_session, 'all_pdf_tutorials' => $all_pdf_tutorials]);
    }

    public function view_of_admin_for_video_type_tutorial()
    {
        $admin_session = Session::get('admin_session');
        $admin_id = $admin_session->id;
        $all_video_tutorials = video_tutorials_info_table::all();
        return view('view_of_admin_for_video_type_tutorial', ['admin_session' => $admin_session, 'all_video_tutorials' => $all_video_tutorials]);
    }

    public function video_pdf_show_tutorials_switching_route_at_admin(Request $request){

        $selectedTutorialType = $request->input('tutorial_type');

        if ($selectedTutorialType === 'PDF')
        {
            return redirect()->route('view_of_admin_for_pdf_type_tutorial');
        }elseif($selectedTutorialType === 'Video')
        {
            return redirect()->route('view_of_admin_for_video_type_tutorial');
        }
    }

    public function deleting_video_tutorial_from_admin($id){
        $video_tutorial_to_delete_from_admin = video_tutorials_info_table::find($id);
        $video_tutorial_to_delete_from_admin->delete();
        return redirect()->back()->with('delete_video_tutorial_from_admin_route_msg', 'Video Deleted Successfully...!');
    }

    public function deleting_pdf_tutorial_from_admin($id){
        $pdf_tutorial_to_delete_from_admin = pdf_tutorials_info_table::find($id);
        $pdf_tutorial_to_delete_from_admin->delete();
        return redirect()->back()->with('delete_pdf_tutorial_from_admin_route_msg', 'PDF Deleted Successfully...!');
    }

    public function deleting_student_record_from_admin($id){
        $student_to_delete_from_admin = students_info_table::find($id);
    
        if ($student_to_delete_from_admin) {
            $student_otp_record_to_delete_from_admin = student_otp_table::where('s_id', $id)->first();
    
            if ($student_otp_record_to_delete_from_admin) {
                $student_otp_record_to_delete_from_admin->delete();
            }
    
            $student_to_delete_from_admin->delete();
    
            return redirect()->back()->with('delete_student_from_admin_route_msg', 'Student Deleted Successfully...!');
        } else {
            return redirect()->back()->with('delete_student_from_admin_route_msg', 'Student Not Found...!');
        }
    }

    public function deleting_faculty_record_from_admin($id){
        $faculty_to_delete_from_admin = faculties_info_table::find($id);
    
        if ($faculty_to_delete_from_admin) {
            $faculty_otp_record_to_delete_from_admin = faculty_otp_table::where('f_id', $id)->first();
            $faculty_video_tutorial_record_to_delete_from_admin = video_tutorials_info_table::where('faculty_id', $id)->first();
            $faculty_pdf_tutorial_record_to_delete_from_admin = pdf_tutorials_info_table::where('faculty_id', $id)->first();
    
            if ($faculty_otp_record_to_delete_from_admin) {
                $faculty_otp_record_to_delete_from_admin->delete();
            }

            if ($faculty_video_tutorial_record_to_delete_from_admin) {
                $faculty_video_tutorial_record_to_delete_from_admin->delete();
            }

            if ($faculty_pdf_tutorial_record_to_delete_from_admin) {
                $faculty_pdf_tutorial_record_to_delete_from_admin->delete();
            }
    
            $faculty_to_delete_from_admin->delete();
    
            return redirect()->back()->with('delete_faculty_from_admin_route_msg', 'Faculty Deleted Successfully...!');
        } else {
            return redirect()->back()->with('delete_faculty_from_admin_route_msg', 'Faculty Not Found...!');
        }
    }

    public function updating_video_tutorial_from_admin_page($id){
        $video_tutorial_to_update_from_admin = video_tutorials_info_table::find($id);
        $all_languages = languages_info_table::all();
        $all_courses = Courses_info_table::all();
        $all_subjects = subjects_info_table::all();
        $admin_session = Session::get('admin_session');
        return view('updating_video_tutorial_from_admin_page', compact('admin_session', 'all_languages', 'all_courses', 'all_subjects', 'video_tutorial_to_update_from_admin'));
    }

    public function show_current_video_to_admin_for_update_video_tutorial_page($id, $video_tutorial_id){
        $current_video_to_show = video_tutorials_info_table::find($video_tutorial_id);
        $admin_session = Session::get('admin_session');
        return view('show_current_video_to_admin_for_update_video_tutorial_page', compact('admin_session', 'current_video_to_show'));
    }

    public function show_current_thumbnail_image_to_admin_for_update_video_tutorial_page($id, $video_tutorial_id){
        $current_thumnail_image_to_show = video_tutorials_info_table::find($video_tutorial_id);
        $admin_session = Session::get('admin_session');
        return view('show_current_thumbnail_image_to_admin_for_update_video_tutorial_page', compact('admin_session', 'current_thumnail_image_to_show'));
    }

    public function updating_video_tutorial_from_admin_page_form_submission(Request $request, $id)
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
                'video_tutorial_status' => 'required|string',
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
        $videoTutorialToUpdate->video_tutorial_status = $request->input('video_tutorial_status');

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

    public function updating_pdf_tutorial_from_admin_page($id){
        $pdf_tutorial_to_update_from_admin = pdf_tutorials_info_table::find($id);
        $all_languages = languages_info_table::all();
        $all_courses = Courses_info_table::all();
        $all_subjects = subjects_info_table::all();
        $admin_session = Session::get('admin_session');
        return view('updating_pdf_tutorial_from_admin_page', compact('admin_session', 'all_languages', 'all_courses', 'all_subjects', 'pdf_tutorial_to_update_from_admin'));
    }

    public function show_current_pdf_to_admin_for_update_pdf_tutorial_page($id, $pdf_tutorial_id){
        $current_pdf_to_show = pdf_tutorials_info_table::find($pdf_tutorial_id);
        $admin_session = Session::get('admin_session');
        return view('show_current_pdf_to_admin_for_update_pdf_tutorial_page', compact('admin_session', 'current_pdf_to_show'));
    }

    public function show_current_thumbnail_image_to_admin_for_update_pdf_tutorial_page($id, $pdf_tutorial_id){
        $current_thumbnail_image_to_show = pdf_tutorials_info_table::find($pdf_tutorial_id);
        $admin_session = Session::get('admin_session');
        return view('show_current_thumbnail_image_to_admin_for_update_pdf_tutorial_page', compact('admin_session', 'current_thumbnail_image_to_show'));
    }

    public function updating_pdf_tutorial_from_admin_page_form_submission(Request $request, $id)
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
                'PDF_tutorial_status' => 'required|string',
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
        $pdfTutorialToUpdate->PDF_tutorial_status = $request->input('PDF_tutorial_status');

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

    public function main_admin_dashboard_show_tutorials_page_with_alert(){
        return redirect()->route('main_admin_dashboard_show_tutorials_page')->with('alert', 'In order to access the update page, please select any item for update operation From the All Tutorials');
    }

    public function main_admin_dashboard_nothing_to_show_in_tutorial_types(){
        $admin_session = Session::get('admin_session');
        return view('main_admin_dashboard_nothing_to_show_in_tutorial_types', compact('admin_session'));
    }

    public function main_admin_dashboard_nothing_to_show_in_video_type_tutorials(){
        $admin_session = Session::get('admin_session');
        return view('main_admin_dashboard_nothing_to_show_in_video_type_tutorials', compact('admin_session'));
    }
    
    public function main_admin_dashboard_nothing_to_show_in_pdf_type_tutorials(){
        $admin_session = Session::get('admin_session');
        return view('main_admin_dashboard_nothing_to_show_in_pdf_type_tutorials', compact('admin_session'));
    }

    public function main_admin_dashboard_nothing_to_show_in_courses(){
        $admin_session = Session::get('admin_session');
        return view('main_admin_dashboard_nothing_to_show_in_courses', compact('admin_session'));
    }

    public function main_admin_dashboard_nothing_to_show_in_subscription(){
        $admin_session = Session::get('admin_session');
        return view('main_admin_dashboard_nothing_to_show_in_subscription', compact('admin_session'));
    }

    public function main_admin_dashboard_nothing_to_show_in_subjects(){
        $admin_session = Session::get('admin_session');
        return view('main_admin_dashboard_nothing_to_show_in_subjects', compact('admin_session'));
    }

    public function main_admin_dashboard_nothing_to_show_in_language(){
        $admin_session = Session::get('admin_session');
        return view('main_admin_dashboard_nothing_to_show_in_language', compact('admin_session'));
    }

    public function main_admin_dashboard_nothing_to_show_in_students_record(){
        $admin_session = Session::get('admin_session');
        return view('main_admin_dashboard_nothing_to_show_in_students_record', compact('admin_session'));
    }

    public function main_admin_dashboard_nothing_to_show_in_faculties_record(){
        $admin_session = Session::get('admin_session');
        return view('main_admin_dashboard_nothing_to_show_in_faculties_record', compact('admin_session'));
    }

    public function main_admin_dashboard_nothing_to_show_in_hero_images(){
        $admin_session = Session::get('admin_session');
        return view('main_admin_dashboard_nothing_to_show_in_hero_images', compact('admin_session'));
    }

    public function main_admin_dashboard_nothing_to_show_in_old_question_paper_record(){
        $admin_session = Session::get('admin_session');
        return view('main_admin_dashboard_nothing_to_show_in_old_question_paper_record', compact('admin_session'));
    }

    public function main_admin_dashboard_page_for_updating_student_record_from_admin($id){
        $student_record_to_update_from_admin = students_info_table::find($id);
        $admin_session = Session::get('admin_session');
        return view('main_admin_dashboard_page_for_updating_student_record_from_admin', compact('admin_session', 'student_record_to_update_from_admin'));
    }

    public function updating_student_user_record_from_admin_page_form_submission(Request $request, $id){
        $studentToUpdate = students_info_table::find($id);

        try {
            // Validate input data
            $validatedData = $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:students_info,email,' . $id,
                'phone_no' => 'required|string|unique:students_info,phone_no,' . $id,
                'date_of_birth' => 'required|date',
                'username' => 'required|string|unique:students_info,username,' . $id,
                'password' => 'nullable|string',
                'confirm_password' => 'required|string',
            ], [
                'name.required' => 'Please enter your name.',
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

        $studentToUpdate->name = $request->input('name');
        $studentToUpdate->email = $request->input('email');
        $studentToUpdate->phone_no = $request->input('phone_no');
        $studentToUpdate->date_of_birth = $request->input('date_of_birth');
        $studentToUpdate->username = $request->input('username');

        if ($request->filled('confirm_password')) {
            $studentToUpdate->password = bcrypt($request->input('confirm_password'));
            $studentToUpdate->confirm_password = $request->input('confirm_password'); 
        }

        $studentToUpdate->save();

        return redirect()->back()->with('update_student_record_msg', 'Changes Saved Successfully!');
    }

    public function main_admin_dashboard_page_for_updating_faculty_record_from_admin($id){
        $faculty_record_to_update_from_admin = faculties_info_table::find($id);
        $admin_session = Session::get('admin_session');
        return view('main_admin_dashboard_page_for_updating_faculty_record_from_admin', compact('admin_session', 'faculty_record_to_update_from_admin'));
    }

    public function updating_faculty_user_record_from_admin_page_form_submission(Request $request, $id){
        $faculty_to_update = faculties_info_table::find($id);

        if (!$faculty_to_update) {
            echo "faculty not found!";
            return;
        }

        try {
            $validatedData = $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:faculties_informations,email,' . $id,
                'phone_no' => 'required|string|unique:faculties_informations,phone_no,' . $id,
                'date_of_birth' => 'required|string',
                'username' => 'required|string|unique:faculties_informations,username,' . $id,
                'password' => 'nullable|string',
                'confirm_password' => 'required|string',
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
    
            echo '<script>';
            foreach ($errorMessages as $errorMessage) {
                echo 'alert("' . $errorMessage . '");';
            }
            echo '</script>';
            return;
        }

        if ($request->filled('confirm_password')) {
            $faculty_to_update->password = bcrypt($request->input('confirm_password'));
            $faculty_to_update->confirm_password = $request->input('confirm_password');
        }

        if ($request->hasFile('proof_of_bank_account_ownership')) {
            $proofOfOwnership = $request->file('proof_of_bank_account_ownership');
            $proofPath = $proofOfOwnership->store('proof_of_bank_account_ownership', 'public');
            $faculty_to_update->proof_of_bank_account_ownership_file_name = $proofOfOwnership->getClientOriginalName();
            $faculty_to_update->proof_of_bank_account_ownership_file_path = $proofPath;
        }

        $faculty_to_update->name = $request->input('name');
        $faculty_to_update->email = $request->input('email');
        $faculty_to_update->phone_no = $request->input('phone_no');
        $faculty_to_update->date_of_birth = $request->input('date_of_birth');
        $faculty_to_update->username = $request->input('username');
        $faculty_to_update->bank_name = $request->input('bank_name');
        $faculty_to_update->bank_branch = $request->input('bank_branch');

        $faculty_to_update->bank_ifsc_code = $request->input('bank_ifsc_code');
        $faculty_to_update->bank_micr_code = $request->input('bank_micr_code');

        $faculty_to_update->account_holder_name = $request->input('account_holder_name');
        $faculty_to_update->account_number = $request->input('account_number');
        $faculty_to_update->account_type = $request->input('account_type');

        $faculty_to_update->save();

        return redirect()->back()->with('update_faculty_record_msg', 'Changes Saved Successfully!');
    }

    public function adding_subscription_form_submission_route(Request $request){
        echo "Hello From adding_subscription_form_submission_route";

        $request->validate([
            'subscription_name' => 'required|string',
            'subscription_title' => 'required|string',
            'subscription_discription' => 'required|string',
            'subscription_price_without_discount' => 'required|numeric',
            'subscription_price_with_discount' => 'required|numeric',
            'subscription_duration_number' => 'required|numeric',
            'subscription_duration_unit' => 'required|string',

            'View_Videos_and_PDFs_access_boolean' => 'required|in:true,false',
            'View_Videos_and_PDFs_access_limitation' => 'required_if:View_Videos_and_PDFs_access_boolean,true|in:Limited,Unlimited',
            'View_Videos_and_PDFs_access_limitation_number' => 'required_if:View_Videos_and_PDFs_access_limitation,Limited|integer|min:1',

            'Download_Videos_and_PDFs_access_boolean' => 'required|in:true,false',
            'Download_Videos_and_PDFs_access_limitation' => 'required_if:Download_Videos_and_PDFs_access_boolean,true|in:Limited,Unlimited',
            'Download_Videos_and_PDFs_access_limitation_number' => 'required_if:Download_Videos_and_PDFs_access_limitation,Limited|integer|min:1',

            'Exams_access_boolean' => 'required|in:true,false',
            'Exams_access_limitation' => 'required_if:Exams_access_boolean,true|in:Limited,Unlimited',
            'Exams_access_limitation_number' => 'required_if:Exams_access_limitation,Limited|integer|min:1',

            'subscription_bg_color' => 'required|string',
            'subscription_thumnail_image' => 'required|image',
            'subscription_bg_pic' => 'required|image',
            'subscription_status' => 'required|in:active,inactive',
        ]);


        // =================== setting values for subscription access ==================== 

        $view_video_pdf_access = "true";
        $view_video_pdf_limite = "";
        $view_video_pdf_limitation_number = "";
        if($request->View_Videos_and_PDFs_access_boolean == "true"){

            $view_video_pdf_limite = $request->View_Videos_and_PDFs_access_limitation;

            if($view_video_pdf_limite == "Unlimited")
            {
                $view_video_pdf_limitation_number = null;
            }
            else{
                $view_video_pdf_limitation_number = $request->View_Videos_and_PDFs_access_limitation_number;
            } 

        }else{
            $view_video_pdf_access = "false";
            $view_video_pdf_limite = null;
            $view_video_pdf_limitation_number = null;
        }
        // -----------------

        $download_view_video_pdf_access = "true";
        $download_view_video_pdf_limite = "";
        $download_view_video_pdf_limitation_number = "";
        if($request->Download_Videos_and_PDFs_access_boolean == "true"){

            $download_view_video_pdf_limite = $request->Download_Videos_and_PDFs_access_limitation;

            if($download_view_video_pdf_limite == "Unlimited")
            {
                $download_view_video_pdf_limitation_number = null;
            }
            else{
                $download_view_video_pdf_limitation_number = $request->Download_Videos_and_PDFs_access_limitation_number;
            }

        }else{
            $download_view_video_pdf_access = "false";
            $download_view_video_pdf_limite = null;
            $download_view_video_pdf_limitation_number = null;
        }
        // -----------------

        $exam_access = "true";
        $exam_limite = "";
        $exam_limitation_number = "";
        if($request->Exams_access_boolean == "true"){

            $exam_limite = $request->Exams_access_limitation;

            if($exam_limite == "Unlimited")
            {
                $exam_limitation_number = null;
            }
            else{
                $exam_limitation_number = $request->Exams_access_limitation_number;
            }

        }else{
            $exam_access = "false";
            $exam_limite = null;
            $exam_limitation_number = null;
        }

        // =================== setted values for subscription access ====================


        $thumbnailPath = $request->file('subscription_thumnail_image')->store('subscription_thumbnail_images','public');

        $bgImagePath = $request->file('subscription_bg_pic')->store('subscription_bg_images','public');

        $admin_session = Session::get('admin_session');
        $admin_id = $admin_session->id;

        subscriptions_table::create([
            'admin_id' => $admin_id, 
            'subscription_name' => $request->subscription_name,
            'subscription_title' => $request->subscription_title,
            'subscription_discription' => $request->subscription_discription,
            'subscription_price_without_discount' => $request->subscription_price_without_discount,
            'subscription_price_with_discount' => $request->subscription_price_with_discount,
            'subscription_duration_number' => $request->subscription_duration_number,
            'subscription_duration_unit' => $request->subscription_duration_unit,
            'full_subscription_duration' => $request->subscription_duration_number . ' ' . $request->subscription_duration_unit,

            'View_Videos_and_PDFs_access_boolean' => $view_video_pdf_access,
            'View_Videos_and_PDFs_access_limitation' => $view_video_pdf_limite,
            'View_Videos_and_PDFs_access_limitation_number' => $view_video_pdf_limitation_number,

            'Download_Videos_and_PDFs_access_boolean' => $download_view_video_pdf_access,
            'Download_Videos_and_PDFs_access_limitation' => $download_view_video_pdf_limite,
            'Download_Videos_and_PDFs_access_limitation_number' => $download_view_video_pdf_limitation_number,

            'Exams_access_boolean' => $exam_access,
            'Exams_access_limitation' => $exam_limite,
            'Exams_access_limitation_number' => $exam_limitation_number,

            'subscription_bg_color' => $request->subscription_bg_color,
            'subscription_thumnail_image' => $thumbnailPath,
            'subscription_bg_pic' => $bgImagePath,
            'subscription_status' => $request->subscription_status,
        ]);

        return redirect()->back()->with('message', 'Subscription Added Successfully...!');
    }

    public function deleting_subscription_record_from_admin($id){
        $subscription_to_delete = subscriptions_table::find($id);
        $subscription_to_delete->delete();
        return redirect()->back()->with('message', 'Subscription Deleted Successfully...!');
    }

    public function main_admin_dashboard_update_subscription_page($id){
        $subscription_to_update = subscriptions_table::find($id);
        $admin_session = Session::get('admin_session');
        return view('main_admin_dashboard_update_subscription_page', compact('admin_session', 'subscription_to_update'));
    }

    public function main_admin_dashboard_show_subscriptions_page_with_alert(){
        return redirect()->route('main_admin_dashboard_show_subscriptions_page')->with('alert', 'In order to access the update page, please select any item for update operation From the All Subscriptions');
    }

    public function updating_subscription_form_submission_route(Request $request, $id){
        echo "Hello from updating_subscription_form_submission_route function";
    
        try {
            $validatedData = $request->validate([
                'subscription_name' => 'required|string',
                'subscription_title' => 'required|string',
                'subscription_discription' => 'required|string',
                'subscription_price_without_discount' => 'required|numeric',
                'subscription_price_with_discount' => 'required|numeric',
                'subscription_duration_number' => 'required|numeric',
                'subscription_duration_unit' => 'required|string',

                'View_Videos_and_PDFs_access_boolean' => 'required|in:true,false',
                'View_Videos_and_PDFs_access_limitation' => 'required_if:View_Videos_and_PDFs_access_boolean,true',
                'View_Videos_and_PDFs_access_limitation_number' => 'required_if:View_Videos_and_PDFs_access_limitation,Limited',

                'Download_Videos_and_PDFs_access_boolean' => 'required|in:true,false',
                'Download_Videos_and_PDFs_access_limitation' => 'required_if:Download_Videos_and_PDFs_access_boolean,true',
                'Download_Videos_and_PDFs_access_limitation_number' => 'required_if:Download_Videos_and_PDFs_access_limitation,Limited',

                'Exams_access_boolean' => 'required|in:true,false',
                'Exams_access_limitation' => 'required_if:Exams_access_boolean,true',
                'Exams_access_limitation_number' => 'required_if:Exams_access_limitation,Limited',

                'subscription_bg_color' => 'required|string',
                'subscription_thumnail_image' => 'nullable|image',
                'subscription_bg_pic' => 'nullable|image',
                'subscription_status' => 'required|in:active,inactive',
            ], [
                'subscription_name.required' => 'Please Enter Subscription Name...',
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
    
        // =================== setting values for subscription access ==================== 

        $view_video_pdf_access = "true";
        $view_video_pdf_limite = "";
        $view_video_pdf_limitation_number = "";
        if($request->View_Videos_and_PDFs_access_boolean == "true"){

            $view_video_pdf_limite = $request->View_Videos_and_PDFs_access_limitation;

            if($view_video_pdf_limite == "Unlimited")
            {
                $view_video_pdf_limitation_number = null;
            }
            else{
                $view_video_pdf_limitation_number = $request->View_Videos_and_PDFs_access_limitation_number;
            } 

        }else{
            $view_video_pdf_access = "false";
            $view_video_pdf_limite = null;
            $view_video_pdf_limitation_number = null;
        }
        // -----------------

        $download_view_video_pdf_access = "true";
        $download_view_video_pdf_limite = "";
        $download_view_video_pdf_limitation_number = "";
        if($request->Download_Videos_and_PDFs_access_boolean == "true"){

            $download_view_video_pdf_limite = $request->Download_Videos_and_PDFs_access_limitation;

            if($download_view_video_pdf_limite == "Unlimited")
            {
                $download_view_video_pdf_limitation_number = null;
            }
            else{
                $download_view_video_pdf_limitation_number = $request->Download_Videos_and_PDFs_access_limitation_number;
            }

        }else{
            $download_view_video_pdf_access = "false";
            $download_view_video_pdf_limite = null;
            $download_view_video_pdf_limitation_number = null;
        }
        // -----------------

        $exam_access = "true";
        $exam_limite = "";
        $exam_limitation_number = "";
        if($request->Exams_access_boolean == "true"){

            $exam_limite = $request->Exams_access_limitation;

            if($exam_limite == "Unlimited")
            {
                $exam_limitation_number = null;
            }
            else{
                $exam_limitation_number = $request->Exams_access_limitation_number;
            }

        }else{
            $exam_access = "false";
            $exam_limite = null;
            $exam_limitation_number = null;
        }

        // =================== setted values for subscription access ====================

        $subscription_record_to_update = subscriptions_table::find($id);

        $subscription_record_to_update->subscription_name = $validatedData['subscription_name'];
        $subscription_record_to_update->subscription_title = $validatedData['subscription_title'];
        $subscription_record_to_update->subscription_discription = $validatedData['subscription_discription'];
        $subscription_record_to_update->subscription_price_without_discount = $validatedData['subscription_price_without_discount'];
        $subscription_record_to_update->subscription_price_with_discount = $validatedData['subscription_price_with_discount'];
        $subscription_record_to_update->subscription_duration_number = $validatedData['subscription_duration_number'];
        $subscription_record_to_update->subscription_duration_unit = $validatedData['subscription_duration_unit'];
        $subscription_record_to_update->full_subscription_duration = $validatedData['subscription_duration_number'] . ' ' . $validatedData['subscription_duration_unit'];

        $subscription_record_to_update->View_Videos_and_PDFs_access_boolean = $view_video_pdf_access;
        $subscription_record_to_update->View_Videos_and_PDFs_access_limitation = $view_video_pdf_limite;
        $subscription_record_to_update->View_Videos_and_PDFs_access_limitation_number = $view_video_pdf_limitation_number;

        $subscription_record_to_update->Download_Videos_and_PDFs_access_boolean = $download_view_video_pdf_access;
        $subscription_record_to_update->Download_Videos_and_PDFs_access_limitation = $download_view_video_pdf_limite;
        $subscription_record_to_update->Download_Videos_and_PDFs_access_limitation_number = $download_view_video_pdf_limitation_number;

        $subscription_record_to_update->Exams_access_boolean = $exam_access;
        $subscription_record_to_update->Exams_access_limitation = $exam_limite;
        $subscription_record_to_update->Exams_access_limitation_number = $exam_limitation_number;

        $subscription_record_to_update->subscription_bg_color = $validatedData['subscription_bg_color'];
        $subscription_record_to_update->subscription_status = $validatedData['subscription_status'];
    
        if ($request->hasFile('subscription_thumnail_image')) {
            $thumnailFile = $request->file('subscription_thumnail_image');
            $thumnailFilePath = $thumnailFile->store('subscription_thumbnail_images', 'public');
            $subscription_record_to_update->subscription_thumnail_image = $thumnailFilePath;
        }

        if ($request->hasFile('subscription_bg_pic')) {
            $bgPicFile = $request->file('subscription_bg_pic');
            $bgPicFilePath = $bgPicFile->store('subscription_bg_images', 'public');
            $subscription_record_to_update->subscription_bg_pic = $bgPicFilePath;
        }
    
        $subscription_record_to_update->save();
    
        return redirect()->back()->with('message', 'Changes Saved Successfully...!');
    }

}
