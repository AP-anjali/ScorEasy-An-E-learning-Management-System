<nav class="sidebar">
        <header id="sticky">
            <div class="image-text">
                <span class="image">
                    <img src="{{ asset('img/sidebar_logo.jpg') }}" alt="logo">
                </span>

                <div class="text header-text">
                    <span class="name"><a href="{{ route('faculty_dashboard') }}">SCOREASY</a></span>
                    <span class="profession">Faculty Dashboard</span>
                </div>
            </div>

            <i class='bx bx-chevron-right toggle'></i>
        </header>

        <div class="menu-bar">
            <div class="menu">
                <li class="search-box">
                    <i class='bx bx-search-alt-2 icon'></i>
                    <input type="text" placeholder="Search...">
                </li>
                <ul class="menu-links">
                    <li class="nav-links" id="Dashboard">
                        <a href="{{ route('faculty_dashboard') }}">
                            <i class='bx bx-home icon' ></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-links" id="Tutorials">
                        <a href="{{ route('faculty_show_tutorials_page') }}">
                            <i class='bx bx-list-check icon' ></i>
                            <span class="text nav-text">Tutorials</span>
                        </a>
                    </li>
                    <li class="nav-links" id="Add-New-Tutorial">
                        <a href="{{ route('faculty_add_new_tutorial_page') }}">
                            <i class='bx bxs-add-to-queue icon' ></i>
                            <span class="text nav-text">Add New Tutorial</span>
                        </a>
                    </li>
                    <li class="nav-links" id="Update-Tutorial">
                        <a href="{{ route('faculty_update_tutorial_page') }}">
                            <i class='bx bxs-analyse icon' ></i>
                            <span class="text nav-text">Update Tutorial</span>
                        </a>
                    </li>
                    <li class="nav-links" id="Playlists">
                        <a href="{{ route('faculty_show_playlists_page') }}">
                            <i class='bx bx-list-check icon' ></i>
                            <span class="text nav-text">Playlists</span>
                        </a>
                    </li>
                    <li class="nav-links" id="Add-New-Playlist">
                        <a href="{{ route('faculty_add_new_playlist_page') }}">
                            <i class='bx bxs-add-to-queue icon' ></i>
                            <span class="text nav-text">Add New Playlist</span>
                        </a>
                    </li>
                    <li class="nav-links" id="Update-Playlist">
                        <a href="{{ route('faculty_update_playlist_page') }}">
                            <i class='bx bxs-analyse icon' ></i>
                            <span class="text nav-text">Update Playlist</span>
                        </a>
                    </li>
                    <li class="nav-links" id="Exams">
                        <a href="{{ route('faculty_show_exams_page') }}">
                            <!-- <i class='bx bx-list-check icon' ></i> -->
                            <span class="material-symbols-outlined icon">app_registration</span>
                            <span class="text nav-text">Exams</span>
                        </a>
                    </li>
                    <li class="nav-links" id="Add-New-Exam">
                        <a href="{{ route('faculty_add_new_exam_page') }}">
                            <span class="material-symbols-outlined icon">docs_add_on</span>
                            <span class="text nav-text">Add New Exam</span>
                        </a>
                    </li>
                    <li class="nav-links" id="Update-Exam">
                        <a href="{{ route('faculty_update_exam_page') }}">
                            <!-- <i class='bx bx-rotate-right icon' ></i> -->
                            <i class='bx bxs-edit icon' ></i>
                            <span class="text nav-text">Update Exam</span>
                        </a>
                    </li>
                    <li class="nav-links" id="Notifications">
                        <a href="{{ route('faculty_notifications_page') }}">
                            <i class='bx bxs-bell-ring icon' ></i>
                            <span class="text nav-text">Notifications</span>
                        </a>
                    </li>
                    <li class="nav-links" id="Feedbacks">
                        <a href="{{ route('faculty_feedbacks_page') }}">
                            <span class="material-symbols-outlined icon">pages</span>
                            <span class="text nav-text">Feedbacks</span>
                        </a>
                    </li>
                    <li class="nav-links" id="Profile">
                        <a href="{{ route('faculty_profile_page') }}">
                            <span class="material-symbols-outlined icon">manage_accounts</span>
                            <span class="text nav-text">Profile</span>
                        </a>
                    </li>
                    <li class="nav-links" id="Revenue">
                        <a href="{{ route('faculty_revenue_page') }}">
                            <span class="material-symbols-outlined icon">trending_up</span>
                            <span class="text nav-text">Revenue</span>
                        </a>
                    </li>
                    <li class="nav-links" id="Settings">
                        <a href="{{ route('faculty_settings_page') }}">
                            <i class='bx bxs-cog icon' ></i>
                            <span class="text nav-text">Settings</span>
                        </a>
                    </li>
                    <li class="nav-links" id="Help">
                        <a href="{{ route('faculty_help_page') }}">
                            <i class='bx bx-help-circle icon' ></i>
                            <span class="text nav-text">Help</span>
                        </a>
                    </li>
                    <li class="nav-links" id="about-us">
                        <a href="{{ route('faculty_about_us_page') }}">
                            <i class='bx bxs-widget icon' ></i>
                            <span class="text nav-text">About Us</span>
                        </a>
                    </li>
                    <li class="nav-links" id="contact-us">
                        <a href="{{ route('faculty_contact_us_page') }}">
                            &nbsp;&nbsp;&nbsp;<i class='bx bx-envelope icont' ></i>
                            <i class='bx bxl-linkedin-square icont' ></i>
                            <i class='bx bx-phone-call icont' ></i>
                            <span class="text nav-text">&nbsp;&nbsp;Contact Us</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="bottom-content">
                <li class="mode">
                    <div class="moon-sun">
                        <i class='bx bx-moon icon moon'></i>
                    </div>
                    <span class="mode-text text">Dark Mode</span>

                    <div class="toggle-switch">
                        <span class="switch"></span>
                    </div>
                </li>
                <li class="">
                    <a href="{{ route('lrf') }}">
                        <i class='bx bx-log-out-circle icon' ></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>
            </div>
        </div>
    </nav>