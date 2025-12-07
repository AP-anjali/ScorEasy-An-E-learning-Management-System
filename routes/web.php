<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;

use App\Http\Controllers\MainAdminController;
use App\Http\Controllers\MainFacultyController;
use App\Http\Controllers\MainStudentController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\RazorpayPaymentController;

use App\Http\Controllers\CreateNewAdminController;

//===================================== Payment routes============================================
Route::get('/for_apply_middleware_on_payment_button', [RazorpayPaymentController::class, 'for_apply_middleware_on_payment_button'])->name('for_apply_middleware_on_payment_button')->middleware('StudentAuth');
Route::post('/subscription_payment_by_students', [RazorpayPaymentController::class, 'subscription_payment_by_students'])->name('subscription_payment_by_students')->middleware('StudentAuth');


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//=========================================== common routes ========================================
Route::get('/missing-internet-connection', [CommonController::class, 'missing_internet_connection'])->name('missing_internet_connection');
Route::get('/page-not-found', [CommonController::class, 'page_not_found'])->name('page_not_found');
Route::get('/UPSC_Old_Exam_Papers', [CommonController::class, 'UPSC_Old_Exam_Papers'])->name('UPSC_Old_Exam_Papers');
Route::get('/GPSC_Old_Exam_Papers', [CommonController::class, 'GPSC_Old_Exam_Papers'])->name('GPSC_Old_Exam_Papers');
Route::get('/showing_all_video_tutorials_at_main_page', [CommonController::class, 'showing_all_video_tutorials_at_main_page'])->name('showing_all_video_tutorials_at_main_page');
Route::get('/showing_all_PDF_tutorials_at_main_page', [CommonController::class, 'showing_all_PDF_tutorials_at_main_page'])->name('showing_all_PDF_tutorials_at_main_page');
Route::get('/showing_only_UPSC_content', [CommonController::class, 'showing_only_UPSC_content'])->name('showing_only_UPSC_content');
Route::get('/showing_only_GPSC_content', [CommonController::class, 'showing_only_GPSC_content'])->name('showing_only_GPSC_content');
Route::get('/display/video/{id}', [CommonController::class, 'video'])->name('video');
Route::get('/display/PDF/{id}', [CommonController::class, 'PDF'])->name('PDF');
Route::get('/display/Old_exam_question_paper_PDF/{id}', [CommonController::class, 'Old_exam_question_paper_PDF'])->name('Old_exam_question_paper_PDF');
Route::get('/test', [CommonController::class, function(){return view('test');}])->name('test');
Route::get('/test_for_stopping_video', [CommonController::class, function(){return view('test_for_stopping_video');}])->name('test_for_stopping_video');
Route::get('/main_student_dashboard_calendar_page', [CommonController::class, function(){return view('main_student_dashboard_calendar_page');}])->name('main_student_dashboard_calendar_page');
Route::get('/test_for_displaying_limited_pages_of_pdf/{id}', [CommonController::class, 'test_for_displaying_limited_pages_of_pdf'])->name('test_for_displaying_limited_pages_of_pdf');

Route::get('/showing_all_Subscriptions_at_main_page', [CommonController::class, 'showing_all_Subscriptions_at_main_page'])->name('showing_all_Subscriptions_at_main_page');
Route::get('/Display/Subscription/{id}', [CommonController::class, 'Subscription'])->name('Subscription');
Route::get('/Display/Subscription_Comparision/{id}', [CommonController::class, 'Subscription_Comparision'])->name('Subscription_Comparision');

route::get('/common_page_nothing_to_show_in_subscriptions_page', [CommonController::class, 'common_page_nothing_to_show_in_subscriptions_page'])->name('common_page_nothing_to_show_in_subscriptions_page');

Route::get('/test_for_subscription', [CommonController::class, function(){return view('test_for_subscription');}])->name('test_for_subscription');
route::get('/contact_us_page_for_subscription', [CommonController::class, 'contact_us_page_for_subscription'])->name('contact_us_page_for_subscription');

//======================Student routes===============================
Route::get('/student_registration_page', [StudentController::class, 'student_registration_page'])->name('student_registration_page')->middleware('StudentLogoutAuth');
Route::get('/student_login_page', [StudentController::class, 'student_login_page'])->name('student_login_page')->middleware('StudentLogoutAuth');
Route::post('/student_registration_form_submission_route', [StudentController::class, 'student_registration_form_submission_route'])->name('student_registration_form_submission_route');
Route::post('/student_login_form_phone_no_submission_route', [StudentController::class, 'student_login_form_phone_no_submission_route'])->name('student_login_form_phone_no_submission_route');
Route::post('/student_login_otp_verification_route', [StudentController::class, 'student_login_otp_verification_route'])->name('student_login_otp_verification_route');
Route::get('/student_otp_verification/{s_id}', [StudentController::class, 'student_otp_verification'])->name('student_otp_verification');
Route::get('/student_login_page/student_login_username_password_verification_page', [StudentController::class, 'student_login_username_password_verification_page'])->name('student_login_username_password_verification_page')->middleware('StudentLogoutAuth');
Route::post('/student_login_form_un_ps_submission_route', [StudentController::class, 'student_login_form_un_ps_submission_route'])->name('student_login_form_un_ps_submission_route');

Route::get('/lrs', [UserController::class, 'stu_reg_log'])->name('lrs');
Route::get('/cp', [UserController::class, 'userindex1'])->name('cp');

Route::get('/students_first_window', [StudentController::class, 'students_first_window'])->name('students_first_window');
route::get('/main_student_feedback_form', [StudentController::class, 'main_student_feedback_form'])->name('main_student_feedback_form')->middleware('StudentAuth');
route::post('/student_feedback_form_submission/{student_id}', [StudentController::class, 'student_feedback_form_submission'])->name('student_feedback_form_submission')->middleware('StudentAuth');
route::get('/student-feedback-submitted', [StudentController::class, 'student_feedback_submitted_page'])->name('student_feedback_submitted_page')->middleware('StudentAuth');

route::get('/dbcon',function(){
    return view('dbcon');
});

route::post('/datainsert', [UserController::class, 'Datainsert'])->name('datainsert');
Route::post('/loginuser', [UserController::class, 'Loginuser'])->name('loginuser');
// route::get('/stu_dashboard', [UserController::class, 'stu_dashboard'])->name('stu_dashboard');
route::get('/student_dashboard', [UserController::class, 'student_dashboard'])->name('student_dashboard');

//for password change
route::post('/changepassword', [UserController::class, 'changepassword'])->name('changepassword');

route::get('/', [MenuController::class, 'main_initial_page'])->name('main_initial_page');
route::get('/main_contact_page', [MenuController::class, 'main_contact_page'])->name('main_contact_page');
route::get('/main_report_page', [MenuController::class, 'main_report_page'])->name('main_report_page');
route::get('/main_about_page', [MenuController::class, 'main_about_page'])->name('main_about_page');

route::get('/home', [MenuController::class, 'home'])->name('home');
route::get('/about', [MenuController::class, 'about'])->name('about');
route::get('/contact', [MenuController::class, 'contact'])->name('contact');
route::get('/account', [MenuController::class, 'account'])->name('account');
route::get('/help', [MenuController::class, 'help'])->name('help');

//======================Faculty routes===============================
Route::get('/faculities_first_window', [FacultyController::class, 'faculities_first_window'])->name('faculities_first_window');
Route::get('/faculty_registration_page', [FacultyController::class, 'faculty_registration_page'])->name('faculty_registration_page');
Route::get('/faculty_login_page', [FacultyController::class, 'faculty_login_page'])->name('faculty_login_page');
Route::post('/faculty_registration_form_submission_route', [FacultyController::class, 'faculty_registration_form_submission_route'])->name('faculty_registration_form_submission_route');
Route::post('/faculty_login_form_phone_no_submission_route', [FacultyController::class, 'faculty_login_form_phone_no_submission_route'])->name('faculty_login_form_phone_no_submission_route');
Route::post('/faculty_login_otp_verification_route', [FacultyController::class, 'faculty_login_otp_verification_route'])->name('faculty_login_otp_verification_route');
Route::get('/faculty_login_page/faculty_login_username_password_verification_page', [FacultyController::class, 'faculty_login_username_password_verification_page'])->name('faculty_login_username_password_verification_page');
Route::post('/faculty_login_form_un_ps_submission_route', [FacultyController::class, 'faculty_login_form_un_ps_submission_route'])->name('faculty_login_form_un_ps_submission_route');
Route::get('/faculty_otp_verification/{f_id}', [FacultyController::class, 'faculty_otp_verification'])->name('faculty_otp_verification');


Route::get('/lrf', [FacultyController::class, 'faculty_reg_log'])->name('lrf');
route::post('/datainsertfaculty', [FacultyController::class, 'datainsertfaculty'])->name('datainsertfaculty');
Route::post('/loginuserfaculty', [FacultyController::class, 'loginuserfaculty'])->name('loginuserfaculty');
Route::get('/faculty_un_ps/{id}', [FacultyController::class, 'faculty_un_ps'])->name('faculty_un_ps');
Route::get('/deleteAndGoHome/{id}', [FacultyController::class, 'deleteAndGoHome'])->name('deleteAndGoHome');
Route::post('/facultyUnPs/{f_id}', [FacultyController::class, 'facultyUnPs'])->name('facultyUnPs');
Route::post('/generatefaculty', [FacultyController::class, 'generatefaculty'])->name('generatefaculty');
Route::get('/verificationF/{f_id}', [FacultyController::class, 'verificationF'])->name('verificationF');
route::get('/faculty_un_ps_verify', [FacultyController::class, 'faculty_un_ps_verify'])->name('faculty_un_ps_verify');
route::post('/faculty_un_ps_verification_method', [FacultyController::class, 'faculty_un_ps_verification_method'])->name('faculty_un_ps_verification_method');

route::get('/faculty_dashboard', [FacultyController::class, 'faculty_dashboard'])->name('faculty_dashboard');
route::get('/faculty_dashboard/faculty_show_tutorials_page', [FacultyController::class, function(){ return view('faculty_show_tutorials_page'); }])->name('faculty_show_tutorials_page');
route::get('/faculty_dashboard/faculty_add_new_tutorial_page', [FacultyController::class, function(){ return view('faculty_add_new_tutorial_page'); }])->name('faculty_add_new_tutorial_page');
route::get('/faculty_dashboard/faculty_update_tutorial_page', [FacultyController::class, function(){ return view('faculty_update_tutorial_page'); }])->name('faculty_update_tutorial_page');

route::get('/faculty_dashboard/faculty_show_playlists_page', [FacultyController::class, function(){ return view('faculty_show_playlists_page'); }])->name('faculty_show_playlists_page');
route::get('/faculty_dashboard/faculty_add_new_playlist_page', [FacultyController::class, function(){ return view('faculty_add_new_playlist_page'); }])->name('faculty_add_new_playlist_page');
route::get('/faculty_dashboard/faculty_update_playlist_page', [FacultyController::class, function(){ return view('faculty_update_playlist_page'); }])->name('faculty_update_playlist_page');


route::get('/faculty_dashboard/faculty_show_exams_page', [FacultyController::class, function(){ return view('faculty_show_exams_page'); }])->name('faculty_show_exams_page');
route::get('/faculty_dashboard/faculty_add_new_exam_page', [FacultyController::class, function(){ return view('faculty_add_new_exam_page'); }])->name('faculty_add_new_exam_page');
route::get('/faculty_dashboard/faculty_update_exam_page', [FacultyController::class, function(){ return view('faculty_update_exam_page'); }])->name('faculty_update_exam_page');
route::get('/faculty_dashboard/faculty_notifications_page', [FacultyController::class, function(){ return view('faculty_notifications_page'); }])->name('faculty_notifications_page');
route::get('/faculty_dashboard/faculty_feedbacks_page', [FacultyController::class, function(){ return view('faculty_feedbacks_page'); }])->name('faculty_feedbacks_page');
route::get('/faculty_dashboard/faculty_profile_page', [FacultyController::class, function(){ return view('faculty_profile_page'); }])->name('faculty_profile_page');
route::get('/faculty_dashboard/faculty_revenue_page', [FacultyController::class, function(){ return view('faculty_revenue_page'); }])->name('faculty_revenue_page');
route::get('/faculty_dashboard/faculty_settings_page', [FacultyController::class, function(){ return view('faculty_settings_page'); }])->name('faculty_settings_page');
route::get('/faculty_dashboard/faculty_help_page', [FacultyController::class, function(){ return view('faculty_help_page'); }])->name('faculty_help_page');
route::get('/faculty_dashboard/faculty_about_us_page', [FacultyController::class, function(){ return view('faculty_about_us_page'); }])->name('faculty_about_us_page');
route::get('/faculty_dashboard/faculty_contact_us_page', [FacultyController::class, function(){ return view('faculty_contact_us_page'); }])->name('faculty_contact_us_page');



//======================Admin routes===============================
Route::get('/Logout_Error', [AdminController::class, 'Logout_Error'])->name('Logout_Error');
route::get('/main_contact_page/captcha_verification_page', [AdminController::class, 'captcha_verification_page'])->name('captcha_verification_page');
route::get('/main_contact_page/captcha_verification_page/captcha_submitted_page', [AdminController::class, 'captcha_submitted_page'])->name('captcha_submitted_page');

Route::get('/admin_login_username_password_verification_page', [AdminController::class, 'admin_login_username_password_verification_page'])->name('admin_login_username_password_verification_page');
route::post('/admin_login_form_un_ps_submission_route', [AdminController::class, 'admin_login_form_un_ps_submission_route'])->name('admin_login_form_un_ps_submission_route');


route::get('/admin_verify_un_ps', [AdminController::class, 'admin_verify_un_ps'])->name('admin_verify_un_ps');
route::post('/admin_un_ps_verification_method', [AdminController::class, 'admin_un_ps_verification_method'])->name('admin_un_ps_verification_method');

route::get('/admin_dashboard', [AdminController::class, 'admin_dashboard'])->name('admin_dashboard');
route::get('/admin_dashboard/admin_show_users_page', [AdminController::class, function(){ return view('admin_show_users_page'); }])->name('admin_show_users_page');
route::get('/admin_dashboard/admin_show_tutorial_page', [AdminController::class, function(){ return view('admin_show_tutorial_page'); }])->name('admin_show_tutorial_page');
route::get('/admin_dashboard/admin_content_management_page', [AdminController::class, function(){ return view('admin_content_management_page'); }])->name('admin_content_management_page');
route::get('/admin_dashboard/admin_show_courses_page', [AdminController::class, function(){ return view('admin_show_courses_page'); }])->name('admin_show_courses_page');
route::get('/admin_dashboard/admin_add_new_course_page', [AdminController::class, function(){ return view('admin_add_new_course_page'); }])->name('admin_add_new_course_page');
route::get('/admin_dashboard/admin_show_subscription_page', [AdminController::class, function(){ return view('admin_show_subscription_page'); }])->name('admin_show_subscription_page');
route::get('/admin_dashboard/admin_add_new_subscription_page', [AdminController::class, function(){ return view('admin_add_new_subscription_page'); }])->name('admin_add_new_subscription_page');

route::get('/admin_dashboard/admin_update_subscription_page', [AdminController::class, function(){ return view('admin_update_subscription_page'); }])->name('admin_update_subscription_page');
route::get('/admin_dashboard/admin_notifications_page', [AdminController::class, function(){ return view('admin_notifications_page'); }])->name('admin_notifications_page');
route::get('/admin_dashboard/admin_feedbacks_page', [AdminController::class, function(){ return view('admin_feedbacks_page'); }])->name('admin_feedbacks_page');
route::get('/admin_dashboard/admin_communication_page', [AdminController::class, function(){ return view('admin_communication_page'); }])->name('admin_communication_page');
route::get('/admin_dashboard/admin_show_income_page', [AdminController::class, function(){ return view('admin_show_income_page'); }])->name('admin_show_income_page');
route::get('/admin_dashboard/admin_show_expences_page', [AdminController::class, function(){ return view('admin_show_expences_page'); }])->name('admin_show_expences_page');
route::get('/admin_dashboard/admin_analytics_page', [AdminController::class, function(){ return view('admin_analytics_page'); }])->name('admin_analytics_page');
route::get('/admin_dashboard/admin_profile_page', [AdminController::class, function(){ return view('admin_profile_page'); }])->name('admin_profile_page');
route::get('/admin_dashboard/admin_settings_page', [AdminController::class, function(){ return view('admin_settings_page'); }])->name('admin_settings_page');
route::get('/admin_dashboard/admin_customization_page', [AdminController::class, function(){ return view('admin_customization_page'); }])->name('admin_customization_page');
route::get('/admin_dashboard/admin_help_page', [AdminController::class, function(){ return view('admin_help_page'); }])->name('admin_help_page');


//======================Logout routes=========================
Route::get('/student_logout', [StudentController::class, 'student_logout'])->name('student_logout');
Route::get('/faculty_logout', [FacultyController::class, 'faculty_logout'])->name('faculty_logout');
Route::get('/admin_logout', [AdminController::class, 'admin_logout'])->name('admin_logout');

// =======================================
Route::get('/secret_url_for_create_admin', [CreateNewAdminController::class, 'createAdmin'])->name('secret_url_for_create_admin');

// ================================================= ADMIN account (show, update, delete account) (start) =================================================
Route::get('/admin_account/{admin_id}', [MainAdminController::class, 'admin_account'])->name('admin_account')->middleware('AdminAuth');
route::post('/updating_admin_user_record_from_admin_page_form_submission/{id}', [MainAdminController::class, 'updating_admin_user_record_from_admin_page_form_submission'])->name('updating_admin_user_record_from_admin_page_form_submission')->middleware('AdminAuth');
Route::get('/sending_email_for_verify_admin_user/{admin_id}', [MainAdminController::class, 'sending_email_for_verify_admin_user'])->name('sending_email_for_verify_admin_user')->middleware('AdminAuth');
route::post('/verifying_admin_email_verification_code_form_submission/{id}', [MainAdminController::class, 'verifying_admin_email_verification_code_form_submission'])->name('verifying_admin_email_verification_code_form_submission')->middleware('AdminAuth');
route::get('/deleting_admin_account_from_admin/{id}', [MainAdminController::class, 'deleting_admin_account_from_admin'])->name('deleting_admin_account_from_admin')->middleware('AdminAuth');
// ================================================= ADMIN account (show, update, delete account) (end) =================================================


route::get('/main_admin_dashboard', [AdminController::class, 'main_admin_dashboard'])->name('main_admin_dashboard')->middleware('AdminAuth');
route::get('/main_admin_dashboard/main_admin_dashboard_show_students_page', [MainAdminController::class, 'main_admin_dashboard_show_students_page'])->name('main_admin_dashboard_show_students_page')->middleware('AdminAuth');
route::get('/main_admin_dashboard/main_admin_dashboard_show_faculties_page', [MainAdminController::class, 'main_admin_dashboard_show_faculties_page'])->name('main_admin_dashboard_show_faculties_page')->middleware('AdminAuth');
route::get('/main_admin_dashboard/main_admin_dashboard_show_tutorials_page', [MainAdminController::class, 'main_admin_dashboard_show_tutorials_page'])->name('main_admin_dashboard_show_tutorials_page')->middleware('AdminAuth');
route::get('/main_admin_dashboard/main_admin_dashboard_show_courses_page', [MainAdminController::class, 'main_admin_dashboard_show_courses_page'])->name('main_admin_dashboard_show_courses_page')->middleware('AdminAuth');
route::get('/main_admin_dashboard/main_admin_dashboard_add_new_course_page', [MainAdminController::class, 'main_admin_dashboard_add_new_course_page'])->name('main_admin_dashboard_add_new_course_page')->middleware('AdminAuth');
route::get('/main_admin_dashboard/main_admin_dashboard_update_course_page/{id}', [MainAdminController::class, 'main_admin_dashboard_update_course_page'])->name('main_admin_dashboard_update_course_page')->middleware('AdminAuth');

route::get('/main_admin_dashboard/main_admin_dashboard_show_subjects_page', [MainAdminController::class, 'main_admin_dashboard_show_subjects_page'])->name('main_admin_dashboard_show_subjects_page')->middleware('AdminAuth');
route::get('/main_admin_dashboard/main_admin_dashboard_add_new_subject_page', [MainAdminController::class, 'main_admin_dashboard_add_new_subject_page'])->name('main_admin_dashboard_add_new_subject_page')->middleware('AdminAuth');
route::get('/main_admin_dashboard/main_admin_dashboard_update_subject_page/{id}', [MainAdminController::class, 'main_admin_dashboard_update_subject_page'])->name('main_admin_dashboard_update_subject_page')->middleware('AdminAuth');

route::get('/main_admin_dashboard/main_admin_dashboard_show_languages_page', [MainAdminController::class, 'main_admin_dashboard_show_languages_page'])->name('main_admin_dashboard_show_languages_page')->middleware('AdminAuth');
route::get('/main_admin_dashboard/main_admin_dashboard_add_new_language_page', [MainAdminController::class, 'main_admin_dashboard_add_new_language_page'])->name('main_admin_dashboard_add_new_language_page')->middleware('AdminAuth');
route::get('/main_admin_dashboard/main_admin_dashboard_update_language_page/{id}', [MainAdminController::class, 'main_admin_dashboard_update_language_page'])->name('main_admin_dashboard_update_language_page')->middleware('AdminAuth');

route::get('/main_admin_dashboard/main_admin_dashboard_show_tutorial_types_page', [MainAdminController::class, 'main_admin_dashboard_show_tutorial_types_page'])->name('main_admin_dashboard_show_tutorial_types_page')->middleware('AdminAuth');
route::get('/main_admin_dashboard/main_admin_dashboard_add_new_tutorial_types_page', [MainAdminController::class, 'main_admin_dashboard_add_new_tutorial_types_page'])->name('main_admin_dashboard_add_new_tutorial_types_page')->middleware('AdminAuth');
route::get('/main_admin_dashboard/main_admin_dashboard_update_tutorial_types_page/{id}', [MainAdminController::class, 'main_admin_dashboard_update_tutorial_types_page'])->name('main_admin_dashboard_update_tutorial_types_page')->middleware('AdminAuth');

route::get('/main_admin_dashboard/main_admin_dashboard_show_all_old_question_papers_page', [MainAdminController::class, 'main_admin_dashboard_show_all_old_question_papers_page'])->name('main_admin_dashboard_show_all_old_question_papers_page')->middleware('AdminAuth');
route::get('/main_admin_dashboard/main_admin_dashboard_add_new_old_question_paper_page', [MainAdminController::class, 'main_admin_dashboard_add_new_old_question_paper_page'])->name('main_admin_dashboard_add_new_old_question_paper_page')->middleware('AdminAuth');
route::get('/main_admin_dashboard/main_admin_dashboard_update_old_question_paper_page/{id}', [MainAdminController::class, 'main_admin_dashboard_update_old_question_paper_page'])->name('main_admin_dashboard_update_old_question_paper_page')->middleware('AdminAuth');


route::get('/main_admin_dashboard/main_admin_dashboard_show_subscriptions_page', [MainAdminController::class, 'main_admin_dashboard_show_subscriptions_page'])->name('main_admin_dashboard_show_subscriptions_page')->middleware('AdminAuth');

route::get('/main_admin_dashboard/main_admin_dashboard_show_subscriptions_page_preview_page', [MainAdminController::class, 'main_admin_dashboard_show_subscriptions_page_preview_page'])->name('main_admin_dashboard_show_subscriptions_page_preview_page')->middleware('AdminAuth');

route::get('/main_admin_dashboard/main_admin_dashboard_show_subscriptions_page/show_current_thumbnail_image_of_subscription_to_admin/{id}', [MainAdminController::class, 'show_current_thumbnail_image_of_subscription_to_admin'])->name('show_current_thumbnail_image_of_subscription_to_admin')->middleware('AdminAuth');
route::get('/main_admin_dashboard/main_admin_dashboard_show_subscriptions_page/show_current_background_image_of_subscription_to_admin/{id}', [MainAdminController::class, 'show_current_background_image_of_subscription_to_admin'])->name('show_current_background_image_of_subscription_to_admin')->middleware('AdminAuth');

route::get('/deleting_subscription_record_from_admin/{id}', [MainAdminController::class, 'deleting_subscription_record_from_admin'])->name('deleting_subscription_record_from_admin')->middleware('AdminAuth');

route::get('/main_admin_dashboard/main_admin_dashboard_add_new_subscription_page', [MainAdminController::class, 'main_admin_dashboard_add_new_subscription_page'])->name('main_admin_dashboard_add_new_subscription_page')->middleware('AdminAuth');
route::get('/main_admin_dashboard/main_admin_dashboard_update_subscription_page/{id}', [MainAdminController::class, 'main_admin_dashboard_update_subscription_page'])->name('main_admin_dashboard_update_subscription_page')->middleware('AdminAuth');
route::get('/main_admin_dashboard/main_admin_dashboard_show_all_subscribers_page', [MainAdminController::class, 'main_admin_dashboard_show_all_subscribers_page'])->name('main_admin_dashboard_show_all_subscribers_page')->middleware('AdminAuth');
route::get('/main_admin_dashboard/main_admin_dashboard_show_subscriptions_page_with_alert', [MainAdminController::class, 'main_admin_dashboard_show_subscriptions_page_with_alert'])->name('main_admin_dashboard_show_subscriptions_page_with_alert')->middleware('AdminAuth');
route::post('/updating_subscription_form_submission_route/{id}', [MainAdminController::class, 'updating_subscription_form_submission_route'])->name('updating_subscription_form_submission_route');

route::get('/main_admin_dashboard/main_admin_dashboard_show_all_hero_images_page', [MainAdminController::class, 'main_admin_dashboard_show_all_hero_images_page'])->name('main_admin_dashboard_show_all_hero_images_page')->middleware('AdminAuth');
route::get('/main_admin_dashboard/main_admin_dashboard_add_new_hero_image_page', [MainAdminController::class, 'main_admin_dashboard_add_new_hero_image_page'])->name('main_admin_dashboard_add_new_hero_image_page')->middleware('AdminAuth');

route::get('/main_admin_dashboard/main_admin_dashboard_show_notifications_page', [MainAdminController::class, 'main_admin_dashboard_show_notifications_page'])->name('main_admin_dashboard_show_notifications_page')->middleware('AdminAuth');
route::get('/main_admin_dashboard/main_admin_dashboard_show_students_feedback_page', [MainAdminController::class, 'main_admin_dashboard_show_students_feedback_page'])->name('main_admin_dashboard_show_students_feedback_page')->middleware('AdminAuth');
route::get('/main_admin_dashboard/main_admin_dashboard_show_faculties_feedback_page', [MainAdminController::class, 'main_admin_dashboard_show_faculties_feedback_page'])->name('main_admin_dashboard_show_faculties_feedback_page')->middleware('AdminAuth');
route::get('/main_admin_dashboard/main_admin_dashboard_communication_page', [MainAdminController::class, 'main_admin_dashboard_communication_page'])->name('main_admin_dashboard_communication_page')->middleware('AdminAuth');
route::get('/main_admin_dashboard/main_admin_dashboard_show_income_page', [MainAdminController::class, 'main_admin_dashboard_show_income_page'])->name('main_admin_dashboard_show_income_page')->middleware('AdminAuth');
route::get('/main_admin_dashboard/main_admin_dashboard_show_expenses_page', [MainAdminController::class, 'main_admin_dashboard_show_expenses_page'])->name('main_admin_dashboard_show_expenses_page')->middleware('AdminAuth');
route::get('/main_admin_dashboard/main_admin_dashboard_show_analytics_page', [MainAdminController::class, 'main_admin_dashboard_show_analytics_page'])->name('main_admin_dashboard_show_analytics_page')->middleware('AdminAuth');
route::get('/main_admin_dashboard/main_admin_dashboard_show_settings_page', [MainAdminController::class, 'main_admin_dashboard_show_settings_page'])->name('main_admin_dashboard_show_settings_page')->middleware('AdminAuth');
route::get('/main_admin_dashboard/main_admin_dashboard_customization_page', [MainAdminController::class, 'main_admin_dashboard_customization_page'])->name('main_admin_dashboard_customization_page')->middleware('AdminAuth');
route::get('/main_admin_dashboard/main_admin_dashboard_help_page', [MainAdminController::class, 'main_admin_dashboard_help_page'])->name('main_admin_dashboard_help_page')->middleware('AdminAuth');
route::get('/main_admin_dashboard/main_admin_dashboard_documentation_page', [MainAdminController::class, 'main_admin_dashboard_documentation_page'])->name('main_admin_dashboard_documentation_page')->middleware('AdminAuth');

Route::post('/adding_subscription_form_submission_route', [MainAdminController::class, 'adding_subscription_form_submission_route'])->name('adding_subscription_form_submission_route');

// ==============================================
route::post('/main_admin_dashboard/adding_new_course', [MainAdminController::class, 'adding_new_course'])->name('adding_new_course');
route::get('/main_admin_dashboard/delete_course/{id}', [MainAdminController::class, 'delete_course'])->name('delete_course');
Route::post('/main_admin_dashboard/adding_new_subject', [MainAdminController::class, 'adding_new_subject'])->name('adding_new_subject');
route::get('/main_admin_dashboard/delete_subject/{id}', [MainAdminController::class, 'delete_subject'])->name('delete_subject');
route::post('/main_admin_dashboard/adding_new_language', [MainAdminController::class, 'adding_new_language'])->name('adding_new_language');
route::get('/main_admin_dashboard/delete_language/{id}', [MainAdminController::class, 'delete_language'])->name('delete_language');
route::post('/main_admin_dashboard/adding_new_tutorial_type', [MainAdminController::class, 'adding_new_tutorial_type'])->name('adding_new_tutorial_type');
route::get('/main_admin_dashboard/delete_tutorial_type/{id}', [MainAdminController::class, 'delete_tutorial_type'])->name('delete_tutorial_type');

route::post('/main_admin_dashboard/adding_new_hero_image', [MainAdminController::class, 'adding_new_hero_image'])->name('adding_new_hero_image');
route::get('/main_admin_dashboard/delete_hero_image/{id}', [MainAdminController::class, 'delete_hero_image'])->name('delete_hero_image');

Route::post('/main_admin_dashboard/adding_new_old_question_paper', [MainAdminController::class, 'adding_new_old_question_paper'])->name('adding_new_old_question_paper');
Route::get('/Old_Question_Paper_Viewer_for_ADMIN/{id}', [MainAdminController::class, 'Old_Question_Paper_Viewer_for_ADMIN'])->name('Old_Question_Paper_Viewer_for_ADMIN');
Route::get('/Old_Question_Paper_thumbnail_image_Viewer_for_ADMIN/{id}', [MainAdminController::class, 'Old_Question_Paper_thumbnail_image_Viewer_for_ADMIN'])->name('Old_Question_Paper_thumbnail_image_Viewer_for_ADMIN');
route::get('/main_admin_dashboard/delete_old_question_paper/{id}', [MainAdminController::class, 'delete_old_question_paper'])->name('delete_old_question_paper');
route::post('/updating_old_question_paper/{id}', [MainAdminController::class, 'updating_old_question_paper'])->name('updating_old_question_paper');
route::get('/main_admin_dashboard_update_old_question_paper_page/updating_old_question_paper/{id}/show_current_old_question_paper_pdf_to_admin_for_update_old_question_paper_page/{question_paper_id}', [MainAdminController::class, 'show_current_old_question_paper_pdf_to_admin_for_update_old_question_paper_page'])->name('show_current_old_question_paper_pdf_to_admin_for_update_old_question_paper_page')->middleware('AdminAuth');
route::get('/main_admin_dashboard_update_old_question_paper_page/updating_old_question_paper/{id}/show_current_old_question_paper_thumbnail_image_to_admin_for_update_old_question_paper_page/{question_paper_id}', [MainAdminController::class, 'show_current_old_question_paper_thumbnail_image_to_admin_for_update_old_question_paper_page'])->name('show_current_old_question_paper_thumbnail_image_to_admin_for_update_old_question_paper_page')->middleware('AdminAuth');

Route::get('/pdf_viewer/{id}', [MainAdminController::class, 'pdf_viewer'])->name('pdf_viewer');
Route::get('/document_viewer/{id}', [MainAdminController::class, 'document_viewer'])->name('document_viewer');
Route::get('/hero_image_viewer/{id}', [MainAdminController::class, 'hero_image_viewer'])->name('hero_image_viewer');
// Route::get('/PDFs_viewer/{filename}', [MainAdminController::class, 'PDFs_viewer'])->name('PDFs_viewer');
route::post('/main_admin_dashboard/main_admin_dashboard_show_tutorials_page/video_pdf_show_tutorials_switching_route_at_admin', [MainAdminController::class, 'video_pdf_show_tutorials_switching_route_at_admin'])->name('video_pdf_show_tutorials_switching_route_at_admin')->middleware('AdminAuth');
route::get('/main_admin_dashboard/main_admin_dashboard_show_tutorials_page/view_of_admin_for_pdf_type_tutorial', [MainAdminController::class, 'view_of_admin_for_pdf_type_tutorial'])->name('view_of_admin_for_pdf_type_tutorial')->middleware('AdminAuth');
route::get('/main_admin_dashboard/main_admin_dashboard_show_tutorials_page/view_of_admin_for_video_type_tutorial', [MainAdminController::class, 'view_of_admin_for_video_type_tutorial'])->name('view_of_admin_for_video_type_tutorial')->middleware('AdminAuth');

route::get('/main_admin_dashboard/main_admin_dashboard_show_tutorials_page/view_of_admin_for_video_type_tutorial/deleting_video_tutorial_from_admin/{id}', [MainAdminController::class, 'deleting_video_tutorial_from_admin'])->name('deleting_video_tutorial_from_admin')->middleware('AdminAuth');
route::get('/main_admin_dashboard/main_admin_dashboard_show_tutorials_page/view_of_admin_for_video_type_tutorial/deleting_pdf_tutorial_from_admin/{id}', [MainAdminController::class, 'deleting_pdf_tutorial_from_admin'])->name('deleting_pdf_tutorial_from_admin')->middleware('AdminAuth');
route::get('/main_admin_dashboard/main_admin_dashboard_show_students_page/deleting_student_record_from_admin/{id}', [MainAdminController::class, 'deleting_student_record_from_admin'])->name('deleting_student_record_from_admin')->middleware('AdminAuth');
route::get('/main_admin_dashboard/main_admin_dashboard_show_faculties_page/deleting_faculty_record_from_admin/{id}', [MainAdminController::class, 'deleting_faculty_record_from_admin'])->name('deleting_faculty_record_from_admin')->middleware('AdminAuth');

route::get('/main_admin_dashboard/main_admin_dashboard_show_students_page/main_admin_dashboard_page_for_updating_student_record_from_admin/{id}', [MainAdminController::class, 'main_admin_dashboard_page_for_updating_student_record_from_admin'])->name('main_admin_dashboard_page_for_updating_student_record_from_admin')->middleware('AdminAuth');
route::post('/updating_student_user_record_from_admin_page_form_submission/{id}', [MainAdminController::class, 'updating_student_user_record_from_admin_page_form_submission'])->name('updating_student_user_record_from_admin_page_form_submission')->middleware('AdminAuth');

route::get('/main_admin_dashboard/main_admin_dashboard_show_faculties_page/main_admin_dashboard_page_for_updating_faculty_record_from_admin/{id}', [MainAdminController::class, 'main_admin_dashboard_page_for_updating_faculty_record_from_admin'])->name('main_admin_dashboard_page_for_updating_faculty_record_from_admin')->middleware('AdminAuth');
route::post('/updating_faculty_user_record_from_admin_page_form_submission/{id}', [MainAdminController::class, 'updating_faculty_user_record_from_admin_page_form_submission'])->name('updating_faculty_user_record_from_admin_page_form_submission')->middleware('AdminAuth');

route::get('/main_admin_dashboard/main_admin_dashboard_show_tutorials_page/main_admin_dashboard_update_tutorial_page/updating_video_tutorial_from_admin_page/{id}', [MainAdminController::class, 'updating_video_tutorial_from_admin_page'])->name('updating_video_tutorial_from_admin_page')->middleware('AdminAuth');
route::get('/main_admin_dashboard_update_tutorial_page/updating_video_tutorial_from_admin_page/{id}/show_current_video_to_admin_for_update_video_tutorial_page/{video_tutorial_id}', [MainAdminController::class, 'show_current_video_to_admin_for_update_video_tutorial_page'])->name('show_current_video_to_admin_for_update_video_tutorial_page')->middleware('AdminAuth');
route::get('/main_admin_dashboard_update_tutorial_page/updating_video_tutorial_from_admin_page/{id}/show_current_thumbnail_image_to_admin_for_update_video_tutorial_page/{video_tutorial_id}', [MainAdminController::class, 'show_current_thumbnail_image_to_admin_for_update_video_tutorial_page'])->name('show_current_thumbnail_image_to_admin_for_update_video_tutorial_page')->middleware('AdminAuth');
route::post('/updating_video_tutorial_from_admin_page_form_submission/{id}', [MainAdminController::class, 'updating_video_tutorial_from_admin_page_form_submission'])->name('updating_video_tutorial_from_admin_page_form_submission')->middleware('AdminAuth');

route::get('/main_admin_dashboard/main_admin_dashboard_show_tutorials_page/main_admin_dashboard_update_tutorial_page/updating_pdf_tutorial_from_admin_page/{id}', [MainAdminController::class, 'updating_pdf_tutorial_from_admin_page'])->name('updating_pdf_tutorial_from_admin_page')->middleware('AdminAuth');
route::get('/main_admin_dashboard_update_tutorial_page/updating_pdf_tutorial_from_admin_page/{id}/show_current_pdf_to_admin_for_update_pdf_tutorial_page/{pdf_tutorial_id}', [MainAdminController::class, 'show_current_pdf_to_admin_for_update_pdf_tutorial_page'])->name('show_current_pdf_to_admin_for_update_pdf_tutorial_page')->middleware('AdminAuth');
route::get('/main_admin_dashboard_update_tutorial_page/updating_pdf_tutorial_from_admin_page/{id}/show_current_thumbnail_image_to_admin_for_update_pdf_tutorial_page/{pdf_tutorial_id}', [MainAdminController::class, 'show_current_thumbnail_image_to_admin_for_update_pdf_tutorial_page'])->name('show_current_thumbnail_image_to_admin_for_update_pdf_tutorial_page')->middleware('AdminAuth');
route::post('/updating_pdf_tutorial_from_admin_page_form_submission/{id}', [MainAdminController::class, 'updating_pdf_tutorial_from_admin_page_form_submission'])->name('updating_pdf_tutorial_from_admin_page_form_submission')->middleware('AdminAuth');
route::get('/main_admin_dashboard/main_admin_dashboard_show_tutorials_page_with_alert', [MainAdminController::class, 'main_admin_dashboard_show_tutorials_page_with_alert'])->name('main_admin_dashboard_show_tutorials_page_with_alert')->middleware('AdminAuth');

route::get('/main_admin_dashboard/main_admin_dashboard_show_courses_page_with_alert', [MainAdminController::class, 'main_admin_dashboard_show_courses_page_with_alert'])->name('main_admin_dashboard_show_courses_page_with_alert')->middleware('AdminAuth');
route::post('/updating_new_course/{id}', [MainAdminController::class, 'updating_new_course'])->name('updating_new_course');

route::get('/main_admin_dashboard/main_admin_dashboard_show_subjects_page_with_alert', [MainAdminController::class, 'main_admin_dashboard_show_subjects_page_with_alert'])->name('main_admin_dashboard_show_subjects_page_with_alert')->middleware('AdminAuth');
route::post('/updating_new_subject/{id}', [MainAdminController::class, 'updating_new_subject'])->name('updating_new_subject');

route::get('/main_admin_dashboard/main_admin_dashboard_show_languages_page_with_alert', [MainAdminController::class, 'main_admin_dashboard_show_languages_page_with_alert'])->name('main_admin_dashboard_show_languages_page_with_alert')->middleware('AdminAuth');
route::post('/updating_new_language/{id}', [MainAdminController::class, 'updating_new_language'])->name('updating_new_language');

route::get('/main_admin_dashboard/main_admin_dashboard_show_tutorial_types_page_with_alert', [MainAdminController::class, 'main_admin_dashboard_show_tutorial_types_page_with_alert'])->name('main_admin_dashboard_show_tutorial_types_page_with_alert')->middleware('AdminAuth');
route::post('/updating_new_tutorial_type/{id}', [MainAdminController::class, 'updating_new_tutorial_type'])->name('updating_new_tutorial_type');

route::get('/main_admin_dashboard/main_admin_dashboard_show_all_old_question_papers_with_alert', [MainAdminController::class, 'main_admin_dashboard_show_all_old_question_papers_with_alert'])->name('main_admin_dashboard_show_all_old_question_papers_with_alert')->middleware('AdminAuth');


route::get('/main_admin_dashboard/main_admin_dashboard_nothing_to_show_in_tutorial_types', [MainAdminController::class, 'main_admin_dashboard_nothing_to_show_in_tutorial_types'])->name('main_admin_dashboard_nothing_to_show_in_tutorial_types')->middleware('AdminAuth');
route::get('/main_admin_dashboard/main_admin_dashboard_nothing_to_show_in_video_type_tutorials', [MainAdminController::class, 'main_admin_dashboard_nothing_to_show_in_video_type_tutorials'])->name('main_admin_dashboard_nothing_to_show_in_video_type_tutorials')->middleware('AdminAuth');
route::get('/main_admin_dashboard/main_admin_dashboard_nothing_to_show_in_pdf_type_tutorials', [MainAdminController::class, 'main_admin_dashboard_nothing_to_show_in_pdf_type_tutorials'])->name('main_admin_dashboard_nothing_to_show_in_pdf_type_tutorials')->middleware('AdminAuth');
route::get('/main_admin_dashboard/main_admin_dashboard_nothing_to_show_in_courses', [MainAdminController::class, 'main_admin_dashboard_nothing_to_show_in_courses'])->name('main_admin_dashboard_nothing_to_show_in_courses')->middleware('AdminAuth');
route::get('/main_admin_dashboard/main_admin_dashboard_nothing_to_show_in_subscription', [MainAdminController::class, 'main_admin_dashboard_nothing_to_show_in_subscription'])->name('main_admin_dashboard_nothing_to_show_in_subscription')->middleware('AdminAuth');
route::get('/main_admin_dashboard/main_admin_dashboard_nothing_to_show_in_subjects', [MainAdminController::class, 'main_admin_dashboard_nothing_to_show_in_subjects'])->name('main_admin_dashboard_nothing_to_show_in_subjects')->middleware('AdminAuth');
route::get('/main_admin_dashboard/main_admin_dashboard_nothing_to_show_in_language', [MainAdminController::class, 'main_admin_dashboard_nothing_to_show_in_language'])->name('main_admin_dashboard_nothing_to_show_in_language')->middleware('AdminAuth');
route::get('/main_admin_dashboard/main_admin_dashboard_nothing_to_show_in_students_record', [MainAdminController::class, 'main_admin_dashboard_nothing_to_show_in_students_record'])->name('main_admin_dashboard_nothing_to_show_in_students_record')->middleware('AdminAuth');
route::get('/main_admin_dashboard/main_admin_dashboard_nothing_to_show_in_faculties_record', [MainAdminController::class, 'main_admin_dashboard_nothing_to_show_in_faculties_record'])->name('main_admin_dashboard_nothing_to_show_in_faculties_record')->middleware('AdminAuth');
route::get('/main_admin_dashboard/main_admin_dashboard_nothing_to_show_in_hero_images', [MainAdminController::class, 'main_admin_dashboard_nothing_to_show_in_hero_images'])->name('main_admin_dashboard_nothing_to_show_in_hero_images')->middleware('AdminAuth');
route::get('/main_admin_dashboard/main_admin_dashboard_nothing_to_show_in_old_question_paper_record', [MainAdminController::class, 'main_admin_dashboard_nothing_to_show_in_old_question_paper_record'])->name('main_admin_dashboard_nothing_to_show_in_old_question_paper_record')->middleware('AdminAuth');

//=================================== main faculty dashboard routes ==================


// ================================================= faculty account (show, update, delete account) (start) =================================================
Route::get('/faculty_account/{faculty_id}', [MainFacultyController::class, 'faculty_account'])->name('faculty_account')->middleware('FacultyAuth');
route::post('/updating_faculty_user_record_from_faculty_page_form_submission/{id}', [MainFacultyController::class, 'updating_faculty_user_record_from_faculty_page_form_submission'])->name('updating_faculty_user_record_from_faculty_page_form_submission')->middleware('FacultyAuth');
Route::get('/sending_email_for_verify_faculty_user/{faculty_id}', [MainFacultyController::class, 'sending_email_for_verify_faculty_user'])->name('sending_email_for_verify_faculty_user')->middleware('FacultyAuth');
route::post('/verifying_faculty_email_verification_code_form_submission/{id}', [MainFacultyController::class, 'verifying_faculty_email_verification_code_form_submission'])->name('verifying_faculty_email_verification_code_form_submission')->middleware('FacultyAuth');
route::get('/deleting_faculty_account_from_faculty/{id}', [MainFacultyController::class, 'deleting_faculty_account_from_faculty'])->name('deleting_faculty_account_from_faculty')->middleware('FacultyAuth');
route::get('/showing_proof_of_bank_account_ownership_to_faculty_for_account/{id}', [MainFacultyController::class, 'showing_proof_of_bank_account_ownership_to_faculty_for_account'])->name('showing_proof_of_bank_account_ownership_to_faculty_for_account')->middleware('FacultyAuth');
// ================================================= faculty account (show, update, delete account) (end) =================================================


route::get('/main_faculty_feedback_form', [MainFacultyController::class, 'main_faculty_feedback_form'])->name('main_faculty_feedback_form')->middleware('FacultyAuth');
route::post('/faculty_feedback_form_submission/{faculty_id}', [MainFacultyController::class, 'faculty_feedback_form_submission'])->name('faculty_feedback_form_submission')->middleware('FacultyAuth');
route::get('/feedback-submitted', [MainFacultyController::class, 'faculty_feedback_submitted_page'])->name('faculty_feedback_submitted_page')->middleware('FacultyAuth');

route::get('/main_faculty_dashboard', [MainFacultyController::class, 'main_faculty_dashboard'])->name('main_faculty_dashboard')->middleware('FacultyAuth');
route::get('/main_faculty_dashboard/main_faculty_dashboard_show_all_tutorials_page', [MainFacultyController::class, 'main_faculty_dashboard_show_all_tutorials_page'])->name('main_faculty_dashboard_show_all_tutorials_page')->middleware('FacultyAuth');
route::get('/main_faculty_dashboard/main_faculty_dashboard_add_new_tutorial_page', [MainFacultyController::class, 'main_faculty_dashboard_add_new_tutorial_page'])->name('main_faculty_dashboard_add_new_tutorial_page')->middleware('FacultyAuth');
route::get('/main_faculty_dashboard/main_faculty_dashboard_update_tutorial_page_with_alert', [MainFacultyController::class, 'main_faculty_dashboard_update_tutorial_page_with_alert'])->name('main_faculty_dashboard_update_tutorial_page_with_alert')->middleware('FacultyAuth');
route::get('/main_faculty_dashboard/main_faculty_dashboard_show_all_playlists_page', [MainFacultyController::class, 'main_faculty_dashboard_show_all_playlists_page'])->name('main_faculty_dashboard_show_all_playlists_page')->middleware('FacultyAuth');
route::get('/main_faculty_dashboard/main_faculty_dashboard_add_new_playlist_page', [MainFacultyController::class, 'main_faculty_dashboard_add_new_playlist_page'])->name('main_faculty_dashboard_add_new_playlist_page')->middleware('FacultyAuth');
route::get('/main_faculty_dashboard/main_faculty_dashboard_update_playlist_page', [MainFacultyController::class, 'main_faculty_dashboard_update_playlist_page'])->name('main_faculty_dashboard_update_playlist_page')->middleware('FacultyAuth');
route::get('/main_faculty_dashboard/main_faculty_dashboard_show_all_exams_page', [MainFacultyController::class, 'main_faculty_dashboard_show_all_exams_page'])->name('main_faculty_dashboard_show_all_exams_page')->middleware('FacultyAuth');
route::get('/main_faculty_dashboard/main_faculty_dashboard_add_new_exam_page', [MainFacultyController::class, 'main_faculty_dashboard_add_new_exam_page'])->name('main_faculty_dashboard_add_new_exam_page')->middleware('FacultyAuth');
route::get('/main_faculty_dashboard/main_faculty_dashboard_update_exam_page', [MainFacultyController::class, 'main_faculty_dashboard_update_exam_page'])->name('main_faculty_dashboard_update_exam_page')->middleware('FacultyAuth');
route::get('/main_faculty_dashboard/main_faculty_dashboard_show_payment_notifications_page', [MainFacultyController::class, 'main_faculty_dashboard_show_payment_notifications_page'])->name('main_faculty_dashboard_show_payment_notifications_page')->middleware('FacultyAuth');
route::get('/main_faculty_dashboard/main_faculty_dashboard_show_income_page', [MainFacultyController::class, 'main_faculty_dashboard_show_income_page'])->name('main_faculty_dashboard_show_income_page')->middleware('FacultyAuth');
route::get('/main_faculty_dashboard/main_faculty_dashboard_show_total_of_subscribers_page', [MainFacultyController::class, 'main_faculty_dashboard_show_total_of_subscribers_page'])->name('main_faculty_dashboard_show_total_of_subscribers_page')->middleware('FacultyAuth');
route::get('/main_faculty_dashboard/main_faculty_dashboard_show_student_notification_page', [MainFacultyController::class, 'main_faculty_dashboard_show_student_notification_page'])->name('main_faculty_dashboard_show_student_notification_page')->middleware('FacultyAuth');
route::get('/main_faculty_dashboard/main_faculty_dashboard_show_admin_notification_page', [MainFacultyController::class, 'main_faculty_dashboard_show_admin_notification_page'])->name('main_faculty_dashboard_show_admin_notification_page')->middleware('FacultyAuth');
route::get('/main_faculty_dashboard/main_faculty_dashboard_show_student_feedback_page', [MainFacultyController::class, 'main_faculty_dashboard_show_student_feedback_page'])->name('main_faculty_dashboard_show_student_feedback_page')->middleware('FacultyAuth');
route::get('/main_faculty_dashboard/main_faculty_dashboard_student_communication_by_mail_page', [MainFacultyController::class, 'main_faculty_dashboard_student_communication_by_mail_page'])->name('main_faculty_dashboard_student_communication_by_mail_page')->middleware('FacultyAuth');
route::get('/main_faculty_dashboard/main_faculty_dashboard_admin_communication_by_mail_page', [MainFacultyController::class, 'main_faculty_dashboard_admin_communication_by_mail_page'])->name('main_faculty_dashboard_admin_communication_by_mail_page')->middleware('FacultyAuth');
route::get('/main_faculty_dashboard/main_faculty_dashboard_settings_page', [MainFacultyController::class, 'main_faculty_dashboard_settings_page'])->name('main_faculty_dashboard_settings_page')->middleware('FacultyAuth');
route::get('/main_faculty_dashboard/main_faculty_dashboard_help_page', [MainFacultyController::class, 'main_faculty_dashboard_help_page'])->name('main_faculty_dashboard_help_page')->middleware('FacultyAuth');
route::get('/main_faculty_dashboard/main_faculty_dashboard_about_us_page', [MainFacultyController::class, 'main_faculty_dashboard_about_us_page'])->name('main_faculty_dashboard_about_us_page')->middleware('FacultyAuth');
route::get('/main_faculty_dashboard/main_faculty_dashboard_contact_us_page', [MainFacultyController::class, 'main_faculty_dashboard_contact_us_page'])->name('main_faculty_dashboard_contact_us_page')->middleware('FacultyAuth');
route::get('/main_faculty_dashboard/main_faculty_dashboard_documentation_page', [MainFacultyController::class, 'main_faculty_dashboard_documentation_page'])->name('main_faculty_dashboard_documentation_page')->middleware('FacultyAuth');
route::get('/main_faculty_dashboard/main_faculty_dashboard_profile_page', [MainFacultyController::class, 'main_faculty_dashboard_profile_page'])->name('main_faculty_dashboard_profile_page')->middleware('FacultyAuth');
route::get('/main_faculty_dashboard/main_faculty_dashboard_customization_page', [MainFacultyController::class, 'main_faculty_dashboard_customization_page'])->name('main_faculty_dashboard_customization_page')->middleware('FacultyAuth');
// =====================
route::post('/main_faculty_dashboard/main_faculty_dashboard_add_new_tutorial_page/video_pdf_form_switching_route', [MainFacultyController::class, 'video_pdf_form_switching_route'])->name('video_pdf_form_switching_route')->middleware('FacultyAuth');
route::get('/main_faculty_dashboard/main_faculty_dashboard_add_new_tutorial_page/form_for_pdf_type_tutorial', [MainFacultyController::class, 'form_for_pdf_type_tutorial'])->name('form_for_pdf_type_tutorial')->middleware('FacultyAuth');
route::get('/main_faculty_dashboard/main_faculty_dashboard_add_new_tutorial_page/form_for_video_type_tutorial', [MainFacultyController::class, 'form_for_video_type_tutorial'])->name('form_for_video_type_tutorial')->middleware('FacultyAuth');
route::post('/main_faculty_dashboard/main_faculty_dashboard_add_new_tutorial_page/form_for_video_type_tutorial/form_for_video_type_tutorial_submission_route', [MainFacultyController::class, 'form_for_video_type_tutorial_submission_route'])->name('form_for_video_type_tutorial_submission_route')->middleware('FacultyAuth');
route::post('/main_faculty_dashboard/main_faculty_dashboard_add_new_tutorial_page/form_for_video_type_tutorial/form_for_pdf_type_tutorial_submission_route', [MainFacultyController::class, 'form_for_pdf_type_tutorial_submission_route'])->name('form_for_pdf_type_tutorial_submission_route')->middleware('FacultyAuth');


route::post('/main_faculty_dashboard/main_faculty_dashboard_show_all_tutorials_page/video_pdf_show_tutorials_switching_route', [MainFacultyController::class, 'video_pdf_show_tutorials_switching_route'])->name('video_pdf_show_tutorials_switching_route')->middleware('FacultyAuth');
route::get('/main_faculty_dashboard/main_faculty_dashboard_show_all_tutorials_page/view_of_faculty_for_pdf_type_tutorial', [MainFacultyController::class, 'view_of_faculty_for_pdf_type_tutorial'])->name('view_of_faculty_for_pdf_type_tutorial')->middleware('FacultyAuth');
route::get('/main_faculty_dashboard/main_faculty_dashboard_show_all_tutorials_page/view_of_faculty_for_video_type_tutorial', [MainFacultyController::class, 'view_of_faculty_for_video_type_tutorial'])->name('view_of_faculty_for_video_type_tutorial')->middleware('FacultyAuth');
route::get('/main_faculty_dashboard/main_faculty_dashboard_show_all_tutorials_page/view_of_faculty_for_video_type_tutorial/deleting_video_tutorial_from_faculty/{id}', [MainFacultyController::class, 'deleting_video_tutorial_from_faculty'])->name('deleting_video_tutorial_from_faculty')->middleware('FacultyAuth');
route::get('/main_faculty_dashboard/main_faculty_dashboard_show_all_tutorials_page/view_of_faculty_for_video_type_tutorial/deleting_pdf_tutorial_from_faculty/{id}', [MainFacultyController::class, 'deleting_pdf_tutorial_from_faculty'])->name('deleting_pdf_tutorial_from_faculty')->middleware('FacultyAuth');

route::get('/main_faculty_dashboard/main_faculty_dashboard_show_all_tutorials_page/main_faculty_dashboard_update_tutorial_page/updating_video_tutorial_from_faculty_page/{id}', [MainFacultyController::class, 'updating_video_tutorial_from_faculty_page'])->name('updating_video_tutorial_from_faculty_page')->middleware('FacultyAuth');
route::get('/main_faculty_dashboard_update_tutorial_page/updating_video_tutorial_from_faculty_page/{id}/show_current_video_to_faculty_for_update_video_tutorial_page/{video_tutorial_id}', [MainFacultyController::class, 'show_current_video_to_faculty_for_update_video_tutorial_page'])->name('show_current_video_to_faculty_for_update_video_tutorial_page')->middleware('FacultyAuth');
route::get('/main_faculty_dashboard_update_tutorial_page/updating_video_tutorial_from_faculty_page/{id}/show_Current_Thumbnail_Images_to_faculty_for_update_video_tutorial_page/{video_tutorial_id}', [MainFacultyController::class, 'show_Current_Thumbnail_Images_to_faculty_for_update_video_tutorial_page'])->name('show_Current_Thumbnail_Images_to_faculty_for_update_video_tutorial_page')->middleware('FacultyAuth');
route::post('/updating_video_tutorial_from_faculty_page_form_submission/{id}', [MainFacultyController::class, 'updating_video_tutorial_from_faculty_page_form_submission'])->name('updating_video_tutorial_from_faculty_page_form_submission')->middleware('FacultyAuth');

route::get('/main_faculty_dashboard/main_faculty_dashboard_show_all_tutorials_page/main_faculty_dashboard_update_tutorial_page/updating_pdf_tutorial_from_faculty_page/{id}', [MainFacultyController::class, 'updating_pdf_tutorial_from_faculty_page'])->name('updating_pdf_tutorial_from_faculty_page')->middleware('FacultyAuth');
route::get('/main_faculty_dashboard_update_tutorial_page/updating_pdf_tutorial_from_faculty_page/{id}/show_current_pdf_to_faculty_for_update_pdf_tutorial_page/{pdf_tutorial_id}', [MainFacultyController::class, 'show_current_pdf_to_faculty_for_update_pdf_tutorial_page'])->name('show_current_pdf_to_faculty_for_update_pdf_tutorial_page')->middleware('FacultyAuth');
route::get('/main_faculty_dashboard_update_tutorial_page/updating_pdf_tutorial_from_faculty_page/{id}/show_current_thumbnail_image_to_faculty_for_update_pdf_tutorial_page/{pdf_tutorial_id}', [MainFacultyController::class, 'show_current_thumbnail_image_to_faculty_for_update_pdf_tutorial_page'])->name('show_current_thumbnail_image_to_faculty_for_update_pdf_tutorial_page')->middleware('FacultyAuth');
route::post('/updating_pdf_tutorial_from_faculty_page_form_submission/{id}', [MainFacultyController::class, 'updating_pdf_tutorial_from_faculty_page_form_submission'])->name('updating_pdf_tutorial_from_faculty_page_form_submission')->middleware('FacultyAuth');


route::get('/main_faculty_dashboard/main_faculty_dashboard_nothing_to_show_in_video_type_tutorial', [MainFacultyController::class, 'main_faculty_dashboard_nothing_to_show_in_video_type_tutorial'])->name('main_faculty_dashboard_nothing_to_show_in_video_type_tutorial')->middleware('FacultyAuth');
route::get('/main_faculty_dashboard/main_faculty_dashboard_nothing_to_show_in_pdf_type_tutorial', [MainFacultyController::class, 'main_faculty_dashboard_nothing_to_show_in_pdf_type_tutorial'])->name('main_faculty_dashboard_nothing_to_show_in_pdf_type_tutorial')->middleware('FacultyAuth');

//=================================== main Student dashboard routes ==================


// ================================================= student account (show, update, delete account) (start) =================================================
Route::get('/student_account/{student_id}', [MainStudentController::class, 'student_account'])->name('student_account')->middleware('StudentAuth');
route::post('/updating_student_user_record_from_student_page_form_submission/{id}', [MainStudentController::class, 'updating_student_user_record_from_student_page_form_submission'])->name('updating_student_user_record_from_student_page_form_submission')->middleware('StudentAuth');
Route::get('/sending_email_for_verify_student_user/{student_id}', [MainStudentController::class, 'sending_email_for_verify_student_user'])->name('sending_email_for_verify_student_user')->middleware('StudentAuth');
route::post('/verifying_student_email_verification_code_form_submission/{id}', [MainStudentController::class, 'verifying_student_email_verification_code_form_submission'])->name('verifying_student_email_verification_code_form_submission')->middleware('StudentAuth');
route::get('/deleting_student_account_from_student/{id}', [MainStudentController::class, 'deleting_student_account_from_student'])->name('deleting_student_account_from_student')->middleware('StudentAuth');
// ================================================= student account (show, update, delete account) (end) =================================================


route::get('/main_student_dashboard', [MainStudentController::class, 'main_student_dashboard'])->name('main_student_dashboard')->middleware('StudentAuth');
route::get('/main_student_dashboard/main_student_dashboard_show_subscribed_educators_page', [MainStudentController::class, 'main_student_dashboard_show_subscribed_educators_page'])->name('main_student_dashboard_show_subscribed_educators_page')->middleware('StudentAuth');
route::get('/main_student_dashboard/main_student_dashboard_show_history_page', [MainStudentController::class, 'main_student_dashboard_show_history_page'])->name('main_student_dashboard_show_history_page')->middleware('StudentAuth');
route::get('/main_student_dashboard/main_student_dashboard_show_videos_to_watch_later_page', [MainStudentController::class, 'main_student_dashboard_show_videos_to_watch_later_page'])->name('main_student_dashboard_show_videos_to_watch_later_page')->middleware('StudentAuth');
route::get('/main_student_dashboard/main_student_dashboard_show_PDFs_to_read_later_page', [MainStudentController::class, 'main_student_dashboard_show_PDFs_to_read_later_page'])->name('main_student_dashboard_show_PDFs_to_read_later_page')->middleware('StudentAuth');
route::get('/main_student_dashboard/main_student_dashboard_show_saved_playlists_page', [MainStudentController::class, 'main_student_dashboard_show_saved_playlists_page'])->name('main_student_dashboard_show_saved_playlists_page')->middleware('StudentAuth');
route::get('/main_student_dashboard/main_student_dashboard_show_liked_videos_page', [MainStudentController::class, 'main_student_dashboard_show_liked_videos_page'])->name('main_student_dashboard_show_liked_videos_page')->middleware('StudentAuth');
route::get('/main_student_dashboard/main_student_dashboard_show_liked_PDFs_page', [MainStudentController::class, 'main_student_dashboard_show_liked_PDFs_page'])->name('main_student_dashboard_show_liked_PDFs_page')->middleware('StudentAuth');
route::get('/main_student_dashboard/main_student_dashboard_show_total_access_time_page', [MainStudentController::class, 'main_student_dashboard_show_total_access_time_page'])->name('main_student_dashboard_show_total_access_time_page')->middleware('StudentAuth');
route::get('/main_student_dashboard/main_student_dashboard_show_all_exams_page', [MainStudentController::class, 'main_student_dashboard_show_all_exams_page'])->name('main_student_dashboard_show_all_exams_page')->middleware('StudentAuth');
route::get('/main_student_dashboard/main_student_dashboard_show_attempted_exams_page', [MainStudentController::class, 'main_student_dashboard_show_attempted_exams_page'])->name('main_student_dashboard_show_attempted_exams_page')->middleware('StudentAuth');
route::get('/main_student_dashboard/main_student_dashboard_show_progress_report_page', [MainStudentController::class, 'main_student_dashboard_show_progress_report_page'])->name('main_student_dashboard_show_progress_report_page')->middleware('StudentAuth');
route::get('/main_student_dashboard/main_student_dashboard_show_progress_chart_page', [MainStudentController::class, 'main_student_dashboard_show_progress_chart_page'])->name('main_student_dashboard_show_progress_chart_page')->middleware('StudentAuth');
route::get('/main_student_dashboard/main_student_dashboard_show_badges_page', [MainStudentController::class, 'main_student_dashboard_show_badges_page'])->name('main_student_dashboard_show_badges_page')->middleware('StudentAuth');
route::get('/main_student_dashboard/main_student_dashboard_show_certificates_page', [MainStudentController::class, 'main_student_dashboard_show_certificates_page'])->name('main_student_dashboard_show_certificates_page')->middleware('StudentAuth');
route::get('/main_student_dashboard/main_student_dashboard_show_course_completion_stamps_page', [MainStudentController::class, 'main_student_dashboard_show_course_completion_stamps_page'])->name('main_student_dashboard_show_course_completion_stamps_page')->middleware('StudentAuth');
route::get('/main_student_dashboard/main_student_dashboard_show_all_comments_page', [MainStudentController::class, 'main_student_dashboard_show_all_comments_page'])->name('main_student_dashboard_show_all_comments_page')->middleware('StudentAuth');
route::get('/main_student_dashboard/main_student_dashboard_show_all_notifications_page', [MainStudentController::class, 'main_student_dashboard_show_all_notifications_page'])->name('main_student_dashboard_show_all_notifications_page')->middleware('StudentAuth');
route::get('/main_student_dashboard/main_student_dashboard_contact_to_faculties_page', [MainStudentController::class, 'main_student_dashboard_contact_to_faculties_page'])->name('main_student_dashboard_contact_to_faculties_page')->middleware('StudentAuth');
route::get('/main_student_dashboard/main_student_dashboard_contact_us_page', [MainStudentController::class, 'main_student_dashboard_contact_us_page'])->name('main_student_dashboard_contact_us_page')->middleware('StudentAuth');
route::get('/main_student_dashboard/main_student_dashboard_show_all_subscriptions_page', [MainStudentController::class, 'main_student_dashboard_show_all_subscriptions_page'])->name('main_student_dashboard_show_all_subscriptions_page')->middleware('StudentAuth');
route::get('/main_student_dashboard/main_student_dashboard_show_my_subscriptions_page', [MainStudentController::class, 'main_student_dashboard_show_my_subscriptions_page'])->name('main_student_dashboard_show_my_subscriptions_page')->middleware('StudentAuth');
route::get('/main_student_dashboard/main_student_dashboard_show_payment_record_page', [MainStudentController::class, 'main_student_dashboard_show_payment_record_page'])->name('main_student_dashboard_show_payment_record_page')->middleware('StudentAuth');
route::get('/main_student_dashboard/main_student_dashboard_show_my_schedule_page', [MainStudentController::class, 'main_student_dashboard_show_my_schedule_page'])->name('main_student_dashboard_show_my_schedule_page')->middleware('StudentAuth');
route::get('/main_student_dashboard/main_student_dashboard_show_calendar_page', [MainStudentController::class, 'main_student_dashboard_show_calendar_page'])->name('main_student_dashboard_show_calendar_page')->middleware('StudentAuth');
route::get('/main_student_dashboard/main_student_dashboard_settings_page', [MainStudentController::class, 'main_student_dashboard_settings_page'])->name('main_student_dashboard_settings_page')->middleware('StudentAuth');
route::get('/main_student_dashboard/main_student_dashboard_about_us_page', [MainStudentController::class, 'main_student_dashboard_about_us_page'])->name('main_student_dashboard_about_us_page')->middleware('StudentAuth');
route::get('/main_student_dashboard/main_student_dashboard_contact_us_page_again', [MainStudentController::class, 'main_student_dashboard_contact_us_page_again'])->name('main_student_dashboard_contact_us_page_again')->middleware('StudentAuth');
route::get('/main_student_dashboard/main_student_dashboard_help_and_support_page', [MainStudentController::class, 'main_student_dashboard_help_and_support_page'])->name('main_student_dashboard_help_and_support_page')->middleware('StudentAuth');
route::get('/main_student_dashboard/main_student_dashboard_show_documentation_page', [MainStudentController::class, 'main_student_dashboard_show_documentation_page'])->name('main_student_dashboard_show_documentation_page')->middleware('StudentAuth');
route::get('/main_student_dashboard/main_student_dashboard_show_profile_page', [MainStudentController::class, 'main_student_dashboard_show_profile_page'])->name('main_student_dashboard_show_profile_page')->middleware('StudentAuth');
route::get('/main_student_dashboard/main_student_dashboard_customization_page', [MainStudentController::class, 'main_student_dashboard_customization_page'])->name('main_student_dashboard_customization_page')->middleware('StudentAuth');
