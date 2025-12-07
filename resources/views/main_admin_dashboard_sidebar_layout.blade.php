<div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>

                        <li class="menu-title">
                            <span>Main Menu</span>
                        </li>


                        <li>
                            <a href="{{ route('main_admin_dashboard') }}"  id = "Dashboard"><i class="feather-grid"></i><span>Dashboard</span></a>
                        </li>

                        <li class="menu-title">
                            <span>Users Management</span>
                        </li>

                        <li class="submenu">
                            <a href="#" id = "Users"><i class="fas fa-graduation-cap"></i> <span>System Users</span> <span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="{{ route('main_admin_dashboard_show_students_page') }}" id="all_students"><i class="fas fa-holly-berry"></i> <span>Students</span></a></li>
                                <li><a href="{{ route('main_admin_dashboard_show_faculties_page') }}" id="all_faculty"><i class="fas fa-holly-berry"></i> <span>Faculties</span></a></li>
                            </ul>
                        </li>

                        <li class="menu-title">
                            <span>Content Management</span>
                        </li>

                        <li class="submenu">
                            <a href="#" id = "Tutorials"><i class="fas fa-graduation-cap"></i> <span>Tutorials</span> <span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="{{ route('main_admin_dashboard_show_tutorials_page') }}" id="all_tutorials"><i class="fas fa-holly-berry"></i> <span>All Tutorials</span></a></li>
                                <li><a href="{{ isset($video_tutorial_to_update_from_admin) ? route('updating_video_tutorial_from_admin_page', $video_tutorial_to_update_from_admin->id) : (isset($pdf_tutorial_to_update_from_admin) ? route('updating_pdf_tutorial_from_admin_page', $pdf_tutorial_to_update_from_admin->id) : route('main_admin_dashboard_show_tutorials_page_with_alert')) }}" id="update_tutorials"><i class="fas fa-holly-berry"></i> <span>Update Tutorial</span></a></li>
                            </ul>
                        </li>

                        <li class="submenu">
                            <a href="#"  id="Courses"><i class="fas fa-building"></i> <span>Courses</span> <span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="{{ route('main_admin_dashboard_show_courses_page') }}" id="All_Courses"><i class="fas fa-holly-berry"></i> <span>All Courses</span></a></li>

                                <li><a href="{{ route('main_admin_dashboard_add_new_course_page') }}" id="Add_New_Course"><i class="fas fa-holly-berry"></i> <span>Add New Course</span></a></li>

                                <li><a href="{{ isset($course_to_update) ? route('main_admin_dashboard_update_course_page', $course_to_update->id) : route('main_admin_dashboard_show_courses_page_with_alert') }}" id="Update_Course"><i class="fas fa-holly-berry"></i> <span>Update Course</span></a></li>
                            </ul>
                        </li>

                        <li class="submenu">
                            <a href="#"  id="Subjects"><i class="fas fa-building"></i> <span>Subjects</span> <span
                                    class="menu-arrow"></span></a>

                            <ul>
                                <li><a href="{{ route('main_admin_dashboard_show_subjects_page') }}" id="All_Subjects"><i class="fas fa-holly-berry"></i> <span>All Subjects</span></a></li>

                                <li><a href="{{ route('main_admin_dashboard_add_new_subject_page') }}" id="Add_New_Subject"><i class="fas fa-holly-berry"></i> <span>Add New Subject</span></a></li>

                                <li><a href="{{ isset($subject_to_update) ? route('main_admin_dashboard_update_subject_page', $subject_to_update->id) : route('main_admin_dashboard_show_subjects_page_with_alert') }}" id="Update_Subject"><i class="fas fa-holly-berry"></i> <span>Update Subject</span></a></li>
                            </ul>
                        </li>

                        <li class="submenu">
                            <a href="#"  id="Languages"><i class="fas fa-building"></i> <span>Languages</span> <span
                                    class="menu-arrow"></span></a>

                            <ul>
                                <li><a href="{{ route('main_admin_dashboard_show_languages_page') }}" id="All_Languages"><i class="fas fa-holly-berry"></i> <span>All Languages</span></a></li>

                                <li><a href="{{ route('main_admin_dashboard_add_new_language_page') }}" id="Add_New_Language"><i class="fas fa-holly-berry"></i> <span>Add New Language</span></a></li>

                                <li><a href="{{ isset($language_to_update) ? route('main_admin_dashboard_update_language_page', $language_to_update->id) : route('main_admin_dashboard_show_languages_page_with_alert') }}" id="Update_Language"><i class="fas fa-holly-berry"></i> <span>Update Language</span></a></li>
                            </ul>
                        </li>

                        <li class="submenu">
                            <a href="#"  id="Tutorial_Types"><i class="fas fa-building"></i> <span>Tutorial Types</span> <span
                                    class="menu-arrow"></span></a>

                            <ul>
                                <li><a href="{{ route('main_admin_dashboard_show_tutorial_types_page') }}" id="All_Tutorial_Types"><i class="fas fa-holly-berry"></i> <span>All Tutorial Types</span></a></li>

                                <li style = "white-space: nowrap;"><a href="{{ route('main_admin_dashboard_add_new_tutorial_types_page') }}" id="Add_New_Tutorial_Type"><i class="fas fa-holly-berry"></i> <span>Add New Tutorial Type</span></a></li>

                                <li><a href="{{ isset($tutorial_type_to_update) ? route('main_admin_dashboard_update_tutorial_types_page', $tutorial_type_to_update->id) : route('main_admin_dashboard_show_tutorial_types_page_with_alert') }}" id="Update_tutorial_type"><i class="fas fa-holly-berry"></i> <span>Update Tutorial Type</span></a></li>
                            </ul>
                        </li>

                        <li class="submenu">
                            <a href="#"  id="Old_Question_Papers"><i class="fas fa-building"></i> <span>Old Question Papers</span> <span
                                    class="menu-arrow"></span></a>

                            <ul>
                                <li><a href="{{ route('main_admin_dashboard_show_all_old_question_papers_page') }}" id="All_Question_Papers"><i class="fas fa-holly-berry"></i> <span>All Question Papers</span></a></li>

                                <li style = "white-space: nowrap;"><a href="{{ route('main_admin_dashboard_add_new_old_question_paper_page') }}" id="Add_New_Paper"><i class="fas fa-holly-berry"></i> <span>Add New Paper</span></a></li>

                                <li><a href="{{ isset($Question_paper_to_update) ? route('main_admin_dashboard_update_old_question_paper_page', $Question_paper_to_update->id) : route('main_admin_dashboard_show_all_old_question_papers_with_alert') }}" id="Update_Paper"><i class="fas fa-holly-berry"></i> <span>Update Added Paper</span></a></li>
                            </ul>
                        </li>

                        <li class="menu-title">
                            <span>Subscription Management</span>
                        </li>

                        <li class="submenu">
                            <a href="#" id = "Subscriptions"><i class="fas fa-book-reader"></i> <span>Subscriptions</span> <span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="{{ route('main_admin_dashboard_show_subscriptions_page') }}" id="All_Subscriptions"><i class="fas fa-holly-berry"></i> <span>All Subscriptions</span></a></li>
                                <li><a href="{{ route('main_admin_dashboard_show_subscriptions_page_preview_page') }}" id="Subscriptions_page_preview" ><i class="fas fa-holly-berry"></i> <span>Page Preview</span></a></li>
                                <li><a href="{{ route('main_admin_dashboard_add_new_subscription_page') }}" id="Add_New_Subscription" style = "white-space: nowrap;"><i class="fas fa-holly-berry"></i> <span>Add New Subscription</span></a></li>
                                <li><a href="{{ isset($subscription_to_update) ? route('main_admin_dashboard_update_subscription_page', $subscription_to_update->id) : route('main_admin_dashboard_show_subscriptions_page_with_alert') }}" id="Update_Subscription"><i class="fas fa-holly-berry"></i> <span>Update Subscription</span></a></li>
                                <li><a href="{{ route('main_admin_dashboard_show_all_subscribers_page') }}" id="All_Subscribers" style = "white-space : nowrap;"><i class="fas fa-holly-berry"></i> <span>Current Subscribers</span></a></li>
                            </ul>
                        </li>

                        <!-- ========================================================================= -->
                        <li class="menu-title">
                            <span>Design View Management</span>
                        </li>

                        <li class="submenu">
                            <a href="#" id = "Hero_Image"><i class="fas fa-graduation-cap"></i> <span>Hero Image</span> <span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="{{ route('main_admin_dashboard_show_all_hero_images_page') }}" id="All_Images"><i class="fas fa-holly-berry"></i> <span>All Images</span></a></li>
                                <li><a href="{{ route('main_admin_dashboard_add_new_hero_image_page') }}" id="Add_New_Image"><i class="fas fa-holly-berry"></i> <span>Add New Image</span></a></li>
                            </ul>
                        </li>
                        <!-- =============================================================================== -->

                        <li class="menu-title">
                            <span>Interaction Management</span>
                        </li>

                        <li>
                            <a  id="Notifications" href="{{ route('main_admin_dashboard_show_notifications_page') }}"><i class="fas fa-file-invoice-dollar"></i> <span>Notifications</span></a>
                        </li>

                        <li class="submenu">
                            <a href="#" id="Feedbacks"><i class="fas fa-clipboard"></i> <span>Feedbacks</span> <span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="{{ route('main_admin_dashboard_show_students_feedback_page') }}">Students Feedbacks</a></li>
                                <li><a href="{{ route('main_admin_dashboard_show_faculties_feedback_page') }}">Faculties Feedbacks</a></li>
                            </ul>
                        </li>

                        <li>
                            <a  id="Communication" href="{{ route('main_admin_dashboard_communication_page') }}"><i class="fas fa-file-invoice-dollar"></i> <span>Communication</span></a>
                        </li>

                        <li class="menu-title">
                            <span>Financial Management</span>
                        </li>

                        <li>
                            <a href="{{ route('main_admin_dashboard_show_income_page') }}" id="Income"><i class="fas fa-holly-berry"></i> <span>Income</span></a>
                        </li>

                        <li>
                            <a href="{{ route('main_admin_dashboard_show_expenses_page') }}" id = "Expenses"><i class="fas fa-comment-dollar"></i> <span>Expenses</span></a>
                        </li>


                        <li class="menu-title">
                            <span>System Report Management</span>
                        </li>

                        <li>
                            <a href="{{ route('main_admin_dashboard_show_analytics_page') }}"  id="Analytics"><i class="fas fa-clipboard-list"></i> <span>Analytics</span></a>
                        </li>

                        <li class="menu-title">
                            <span>Others</span>
                        </li>

                        <li>
                            <a href="{{ route('main_admin_dashboard_show_settings_page') }}"  id="Settings"><i class="fas fa-cog"></i> <span>Settings</span></a>
                        </li>

                        <li>
                            <a href="{{ route('main_admin_dashboard_customization_page') }}"  id="Customization"><i class="fas fa-file"></i> <span>Customization</span></a>
                        </li>

                        <li>
                            <a href="{{ route('main_admin_dashboard_help_page') }}"  id="Help"><i class="fas fa-baseball-ball"></i> <span>Help</span></a>
                        </li>

                        <li>
                            <a href="{{ route('main_admin_dashboard_documentation_page') }}"  id="Documentation"><i class="fas fa-hotel"></i> <span>Documentation</span></a>
                        </li>

                        @if(isset($admin_session))
                            <li>
                                <a href="{{route('admin_account', $admin_session->id)}}"><i class="fas fa-user"></i> <span>Profile</span></a>
                            </li>
                        @endif

                        <li>
                            <a onclick="confirmAdminLogout()" id="logout_menu"><i class="fas fa-bus"></i> <span>Logout</span></a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>