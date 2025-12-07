<nav class="sidebar">
        <header id="sticky">
            <div class="image-text">
                <span class="image">
                    <img src="{{ asset('img/sidebar_logo.jpg') }}" alt="logo">
                </span>

                <div class="text header-text">
                    <span class="name"><a href="{{ route('admin_dashboard') }}">SCOREASY</a></span>
                    <span class="profession">Admin Dashboard</span>
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
                        <a href="{{ route('admin_dashboard') }}">
                            <i class='bx bx-home icon' ></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-links" id="Users">
                        <a href="{{ route('admin_show_users_page') }}">
                            <i class='bx bx-home icon' ></i>
                            <span class="text nav-text">Users</span>
                        </a>
                        <!-- <ul class="menu-links" id="users-sublist">
							<li><a href="">Learners</a></li>
							<li><a href="">Faculties</a></li>
						</ul> -->
                    </li>
                    <li class="nav-links" id="Tutorials">
                        <a href="{{ route('admin_show_tutorial_page') }}">
                            <i class='bx bx-home icon' ></i>
                            <span class="text nav-text">Tutorials</span>
                        </a>
                    </li>
                    <li class="nav-links" id="Content-Management">
                        <a href="{{ route('admin_content_management_page') }}">
                            <i class='bx bx-home icon' ></i>
                            <span class="text nav-text">Content Management</span>
                        </a>
                    </li>
                    <li class="nav-links" id="Courses">
                        <a href="{{ route('admin_show_courses_page') }}">
                            <i class='bx bx-home icon' ></i>
                            <span class="text nav-text">Courses</span>
                        </a>
                    </li>
                    <li class="nav-links" id="Add-New-Course">
                        <a href="{{ route('admin_add_new_course_page') }}">
                            <i class='bx bx-home icon' ></i>
                            <span class="text nav-text">Add New Course</span>
                        </a>
                    </li>
                    <li class="nav-links" id="Subscriptions">
                        <a href="{{ route('admin_show_subscription_page') }}">
                            <i class='bx bx-list-check icon' ></i>
                            <span class="text nav-text">Subscriptions</span>
                        </a>
                    </li>
                    <li class="nav-links" id="Add-New-Subscription">
                        <a href="{{ route('admin_add_new_subscription_page') }}">
                            <i class='bx bxs-add-to-queue icon' ></i>
                            <span class="text nav-text">Add New Subscription</span>
                        </a>
                    </li>
                    <li class="nav-links" id="Update-Subscription">
                        <a href="{{ route('admin_update_subscription_page') }}">
                            <i class='bx bxs-analyse icon' ></i>
                            <span class="text nav-text">Update Subscription</span>
                        </a>
                    </li>
                    <li class="nav-links" id="Notifications">
                        <a href="{{ route('admin_notifications_page') }}">
                            <i class='bx bx-home icon' ></i>
                            <span class="text nav-text">Notifications</span>
                        </a>
                    </li>
                    <li class="nav-links" id="Feedbacks">
                        <a href="{{ route('admin_feedbacks_page') }}">
                            <i class='bx bx-home icon' ></i>
                            <span class="text nav-text">Feedbacks</span>
                        </a>
                    </li>
                    <li class="nav-links" id="Communication">
                        <a href="{{ route('admin_communication_page') }}">
                            <i class='bx bx-home icon' ></i>
                            <span class="text nav-text">Communication</span>
                        </a>
                    </li>
                    <li class="nav-links" id="Income">
                        <a href="{{ route('admin_show_income_page') }}">
                            <i class='bx bx-home icon' ></i>
                            <span class="text nav-text">Income</span>
                        </a>
                    </li>
                    <li class="nav-links" id="Expenses">
                        <a href="{{ route('admin_show_expences_page') }}">
                            <i class='bx bx-home icon' ></i>
                            <span class="text nav-text">Expenses</span>
                        </a>
                    </li>
                    <li class="nav-links" id="Analytics">
                        <a href="{{ route('admin_analytics_page') }}">
                            <i class='bx bx-home icon' ></i>
                            <span class="text nav-text">Analytics</span>
                        </a>
                    </li>
                    <li class="nav-links" id="Profile">
                        <a href="{{ route('admin_profile_page') }}">
                            <i class='bx bx-home icon' ></i>
                            <span class="text nav-text">Profile</span>
                        </a>
                    </li>
                    <li class="nav-links" id="Settings">
                        <a href="{{ route('admin_settings_page') }}">
                            <i class='bx bx-home icon' ></i>
                            <span class="text nav-text">Settings</span>
                        </a>
                    </li>
                    <li class="nav-links" id="Customization">
                        <a href="{{ route('admin_customization_page') }}">
                            <i class='bx bx-home icon' ></i>
                            <span class="text nav-text">Customization</span>
                        </a>
                    </li>
                    <li class="nav-links" id="Help">
                        <a href="{{ route('admin_help_page') }}">
                            <i class='bx bx-home icon' ></i>
                            <span class="text nav-text">Help</span>
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
                    <a href="">
                        <i class='bx bx-log-out-circle icon' ></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>
            </div>
        </div>
    </nav>