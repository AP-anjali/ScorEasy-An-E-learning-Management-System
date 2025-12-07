<div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>

                        <li class="menu-title">
                            <span>Main Menu</span>
                        </li>


                        <li>
                            <a href="{{ route('main_student_dashboard') }}"  id = "Dashboard"><i class="feather-grid"></i><span>Home</span></a>
                        </li>

                        <li class="menu-title">
                            <span>Access Management</span>
                        </li>

                        <li class="submenu">
                            <a href="#" id = "Content_Library"><i class="fas fa-graduation-cap"></i> <span>Content Library</span> <span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="{{ route('main_student_dashboard_show_subscribed_educators_page') }}" id="Subscribed_educators"><i class="fas fa-holly-berry"></i> <span>Subscribed Educators</span></a></li>
                                <li><a href="{{ route('main_student_dashboard_show_history_page') }}" id="History"><i class="fas fa-holly-berry"></i> <span>History</span></a></li>
                                <li><a href="{{ route('main_student_dashboard_show_videos_to_watch_later_page') }}" id="Watch_Later"><i class="fas fa-holly-berry"></i> <span>Watch Later</span></a></li>
                                <li><a href="{{ route('main_student_dashboard_show_PDFs_to_read_later_page') }}" id="Read_Later"><i class="fas fa-holly-berry"></i> <span>Read Later</span></a></li>
                                <li><a href="{{ route('main_student_dashboard_show_saved_playlists_page') }}" id="Saved_Playlists"><i class="fas fa-holly-berry"></i> <span>Saved Playlists</span></a></li>
                                <li><a href="{{ route('main_student_dashboard_show_liked_videos_page') }}" id="Liked_Videos"><i class="fas fa-holly-berry"></i> <span>Liked Videos</span></a></li>
                                <li><a href="{{ route('main_student_dashboard_show_liked_PDFs_page') }}" id="Liked_PDFs"><i class="fas fa-holly-berry"></i> <span>Liked PDFs</span></a></li>
                                <li><a href="{{ route('main_student_dashboard_show_total_access_time_page') }}" id="Total_Access_Time"><i class="fas fa-holly-berry"></i> <span>Total Access Time</span></a></li>
                            </ul>
                        </li>

                        <li class="menu-title">
                            <span>Assessment Management</span>
                        </li>

                        <li class="submenu">
                            <a href="#" id = "Self_Assessment"><i class="fas fa-graduation-cap"></i> <span>Self Assessment</span> <span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="{{ route('main_student_dashboard_show_all_exams_page') }}" id="All_exams"><i class="fas fa-holly-berry"></i> <span>All Exams</span></a></li>
                                <li><a href="{{ route('main_student_dashboard_show_attempted_exams_page') }}" id="Attempted_Exams"><i class="fas fa-holly-berry"></i> <span>Attempted Exams</span></a></li>
                            </ul>
                        </li>

                        <li class="menu-title">
                            <span>Analytics Management</span>
                        </li>

                        <li class="submenu">
                            <a href="#" id = "Progress"><i class="fas fa-graduation-cap"></i> <span>Progress</span> <span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="{{ route('main_student_dashboard_show_progress_report_page') }}" id="Progress_Reports"><i class="fas fa-holly-berry"></i> <span>Progress Reports</span></a></li>
                                <li><a href="{{ route('main_student_dashboard_show_progress_chart_page') }}" id="Progress_Charts"><i class="fas fa-holly-berry"></i> <span>Progress Charts</span></a></li>
                            </ul>
                        </li>

                        <li class="menu-title">
                            <span>Achievements Management</span>
                        </li>

                        <li class="submenu">
                            <a href="#" id = "Rewards"><i class="fas fa-graduation-cap"></i> <span>Rewards</span> <span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="{{ route('main_student_dashboard_show_badges_page') }}" id="Badges"><i class="fas fa-holly-berry"></i> <span>Badges</span></a></li>
                                <li><a href="{{ route('main_student_dashboard_show_certificates_page') }}" id="Certificates"><i class="fas fa-holly-berry"></i> <span>Certificates</span></a></li>
                                <li><a href="{{ route('main_student_dashboard_show_course_completion_stamps_page') }}" id="course_completion_stamps"><i class="fas fa-holly-berry"></i> <span>Completion stamps</span></a></li>
                            </ul>
                        </li>

                        <li class="menu-title">
                            <span>Communication Management</span>
                        </li>

                        <li class="submenu">
                            <a href="#" id = "Communication"><i class="fas fa-graduation-cap"></i> <span>Communication</span> <span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="{{ route('main_student_dashboard_show_all_comments_page') }}" id="All_Comments"><i class="fas fa-holly-berry"></i> <span>All Comments</span></a></li>
                                <li><a href="{{ route('main_student_dashboard_show_all_notifications_page') }}" id="All_Notifications"><i class="fas fa-holly-berry"></i> <span>All Notifications</span></a></li>
                                <li><a href="{{ route('main_student_dashboard_contact_to_faculties_page') }}" id="Contact_to_Faculities"><i class="fas fa-holly-berry"></i> <span>Contact to Faculities</span></a></li>
                                <li><a href="{{ route('main_student_dashboard_contact_us_page') }}" id="Contact_to_Us"><i class="fas fa-holly-berry"></i> <span>Contact to Us</span></a></li>
                            </ul>
                        </li>

                        <li class="menu-title">
                            <span>Subscriptions Management</span>
                        </li>

                        <li class="submenu">
                            <a href="#" id = "Subscriptions"><i class="fas fa-graduation-cap"></i> <span>Subscriptions</span> <span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="{{ route('main_student_dashboard_show_all_subscriptions_page') }}" id="All_Subscriptions"><i class="fas fa-holly-berry"></i> <span>All Subscriptions</span></a></li>
                                <li><a href="{{ route('main_student_dashboard_show_my_subscriptions_page') }}" id="My_Subscriptions"><i class="fas fa-holly-berry"></i> <span>My Subscriptions</span></a></li>
                                <li><a href="{{ route('main_student_dashboard_show_payment_record_page') }}" id="Payment_records"><i class="fas fa-holly-berry"></i> <span>Payment Records</span></a></li>
                            </ul>
                        </li>

                        <li class="menu-title">
                            <span>Schedule Management</span>
                        </li>

                        <li class="submenu">
                            <a href="#" id = "Agile_Agenda"><i class="fas fa-graduation-cap"></i> <span>Agile Agenda</span> <span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="{{ route('main_student_dashboard_show_my_schedule_page') }}" id="My_Schedule"><i class="fas fa-holly-berry"></i> <span>My Schedule</span></a></li>
                                <li><a href="{{ route('main_student_dashboard_calendar_page') }}" id="calendar"><i class="fas fa-holly-berry"></i> <span>Calendar</span></a></li>
                            </ul>
                        </li>

                        <li class="menu-title">
                            <span>About System</span>
                        </li>

                        <li>
                            <a href="{{ route('main_student_dashboard_settings_page') }}" id="Settings"><i class="fas fa-holly-berry"></i> <span>Settings</span></a>
                            <a href="{{ route('main_student_dashboard_about_us_page') }}" id="About_Us"><i class="fas fa-holly-berry"></i> <span>About Us</span></a>
                            <a href="{{ route('main_student_dashboard_contact_us_page_again') }}" id="Contact_Us_again"><i class="fas fa-holly-berry"></i> <span>Contact Us</span></a>
                            <a href="{{ route('main_student_dashboard_help_and_support_page') }}" id="Help"><i class="fas fa-holly-berry"></i> <span>Help & Support</span></a>
                            <a href="{{ route('main_student_dashboard_show_documentation_page') }}" id="Documentation"><i class="fas fa-holly-berry"></i> <span>Documentation</span></a>
                        </li>

                        <li class="menu-title">
                            <span>Others</span>
                        </li>

                        @if(isset($student_session))
                            <li>
                                <a href="{{route('student_account', $student_session->id)}}"  id="Profile"><i class="fas fa-file"></i> <span>Profile</span></a>
                            </li>
                        @endif

                        <li>
                            <a href="{{ route('main_student_dashboard_customization_page') }}"  id="Customization"><i class="fas fa-file"></i> <span>Customization</span></a>
                        </li>

                        <li>
                            <a onclick="confirmStudentLogout()" id="logout_menu"><i class="fas fa-bus"></i> <span>Logout</span></a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>