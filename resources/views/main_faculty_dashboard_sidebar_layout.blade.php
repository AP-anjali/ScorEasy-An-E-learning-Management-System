<div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>

                        <li class="menu-title">
                            <span>Main Menu</span>
                        </li>


                        <li>
                            <a href="{{ route('main_faculty_dashboard') }}"  id = "Dashboard"><i class="feather-grid"></i><span>Dashboard</span></a>
                        </li>

                        <li class="menu-title">
                            <span>Content Management</span>
                        </li>

                        <li class="submenu">
                            <a href="#" id = "Tutorials"><i class="fas fa-graduation-cap"></i> <span>Tutorials</span> <span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="{{ route('main_faculty_dashboard_show_all_tutorials_page') }}" id="all_tutorials"><i class="fas fa-holly-berry"></i> <span>All Tutorials</span></a></li>
                                <li><a href="{{ route('main_faculty_dashboard_add_new_tutorial_page') }}" id="add_new_tutorials"><i class="fas fa-holly-berry"></i> <span>Add New Tutorial</span></a></li>
                                <li><a href="{{ isset($video_tutorial_to_update_from_faculty) ? route('updating_video_tutorial_from_faculty_page', $video_tutorial_to_update_from_faculty->id) : (isset($pdf_tutorial_to_update_from_faculty) ? route('updating_pdf_tutorial_from_faculty_page', $pdf_tutorial_to_update_from_faculty->id) : route('main_faculty_dashboard_update_tutorial_page_with_alert')) }}" id="update_tutorials"><i class="fas fa-holly-berry"></i> <span>Update Tutorial</span></a></li>
                            </ul>
                        </li>

                        <li class="submenu">
                            <a href="#" id = "Playlists"><i class="fas fa-graduation-cap"></i> <span>Playlists</span> <span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="{{ route('main_faculty_dashboard_show_all_playlists_page') }}">All Playlists</a></li>
                                <li><a href="{{ route('main_faculty_dashboard_add_new_playlist_page') }}">Add New Playlist</a></li>
                                <li><a href="{{ route('main_faculty_dashboard_update_playlist_page') }}">Update Playlist</a></li>
                            </ul>
                        </li>

                        <li class="menu-title">
                            <span>Exams Management</span>
                        </li>

                        <li class="submenu">
                            <a href="#"  id="Exams"><i class="fas fa-building"></i> <span>Exams</span> <span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="{{ route('main_faculty_dashboard_show_all_exams_page') }}">All Exams</a></li>
                                <li><a href="{{ route('main_faculty_dashboard_add_new_exam_page') }}">Add New Exam</a></li>
                                <li><a href="{{ route('main_faculty_dashboard_update_exam_page') }}">Update Exam</a></li>
                            </ul>
                        </li>

                        <li class="menu-title">
                            <span>Finance Management</span>
                        </li>

                        <li class="submenu">
                            <a href="#" id = "Revenue"><i class="fas fa-book-reader"></i> <span>Revenue</span> <span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="{{ route('main_faculty_dashboard_show_payment_notifications_page') }}">Payment Notifications</a></li>
                                <li><a href="{{ route('main_faculty_dashboard_show_income_page') }}">Total Income</a></li>
                            </ul>
                        </li>

                        <li class="menu-title">
                            <span>Total Subscribers</span>
                        </li>

                        <li>
                            <a href="{{ route('main_faculty_dashboard_show_total_of_subscribers_page') }}" id = "All_Subscribers"><i class="fas fa-book-reader"></i> <span>All Subscribers</span></a>
                        </li>

                        <li class="menu-title">
                            <span>Notifications</span>
                        </li>

                        <li class="submenu">
                            <a href="#" id="All_Notifications"><i class="fas fa-clipboard"></i> <span>All Notifications</span> <span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="{{ route('main_faculty_dashboard_show_student_notification_page') }}">Students Notifications</a></li>
                                <li><a href="{{ route('main_faculty_dashboard_show_admin_notification_page') }}">Admin Notifications</a></li>
                            </ul>
                        </li>

                        <li class="menu-title">
                            <span>Feedbacks Management</span>
                        </li>

                        <li class="submenu">
                            <a href="#" id="Feedbacks"><i class="fas fa-clipboard"></i> <span>Feedbacks</span> <span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="{{ route('main_faculty_dashboard_show_student_feedback_page') }}">Students Feedbacks</a></li>
                            </ul>
                        </li>

                        <li class="menu-title">
                            <span>Communication</span>
                        </li>

                        <li>
                            <a href="{{ route('main_faculty_dashboard_student_communication_by_mail_page') }}" id="Students_Communication"><i class="fas fa-holly-berry"></i> <span>Students Communication</span></a>
                        </li>

                        <li>
                            <a href="{{ route('main_faculty_dashboard_admin_communication_by_mail_page') }}" id="Admin_communication"><i class="fas fa-holly-berry"></i> <span>Admin Communication</span></a>
                        </li>

                        <li class="menu-title">
                            <span>About System</span>
                        </li>

                        <li>
                            <a href="{{ route('main_faculty_dashboard_settings_page') }}" id="Settings"><i class="fas fa-holly-berry"></i> <span>Settings</span></a>
                            <a href="{{ route('main_faculty_dashboard_about_us_page') }}" id="About_Us"><i class="fas fa-holly-berry"></i> <span>About Us</span></a>
                            <a href="{{ route('main_faculty_dashboard_contact_us_page') }}" id="Contact_Us"><i class="fas fa-holly-berry"></i> <span>Contact Us</span></a>
                            <a href="{{ route('main_faculty_dashboard_help_page') }}" id="Help"><i class="fas fa-holly-berry"></i> <span>Help & Support</span></a>
                            <a href="{{ route('main_faculty_dashboard_documentation_page') }}" id="Documentation"><i class="fas fa-holly-berry"></i> <span>Documentation</span></a>
                        </li>

                        <li class="menu-title">
                            <span>Others</span>
                        </li>

                        @if(isset($faculty_session))
                            <li>
                                <a href="{{route('faculty_account', $faculty_session->id)}}"  id="Profile"><i class="fas fa-file"></i> <span>Profile</span></a>
                            </li>
                        @endif

                        <li>
                            <a href="{{ route('main_faculty_dashboard_customization_page') }}"  id="Customization"><i class="fas fa-file"></i> <span>Customization</span></a>
                        </li>

                        <li>
                            <a onclick="confirmFacultyLogout()" id="logout_menu"><i class="fas fa-bus"></i> <span>Logout</span></a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>