<nav class="sidebar">
        <header id="sticky">
            <div class="image-text">
                <span class="image">
                    <img src="{{ asset('img/sidebar_logo.jpg') }}" alt="logo">
                </span>

                <div class="text header-text">
                    <span class="name"><a href="{{ route('student_dashboard') }}">SCOREASY</a></span>
                    <span class="profession">Student Dashboard</span>
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
                        <a href="{{ route('student_dashboard') }}">
                            <i class='bx bx-home icon' ></i>
                            <span class="text nav-text">Home</span>
                        </a>
                    </li>
                    <li class="nav-links" id="">
                        <a href="{{ route('student_dashboard') }}">
                            <i class='bx bx-home icon' ></i>
                            <span class="text nav-text">My Course</span>
                        </a>
                    </li>
                    <li class="nav-links" id="">
                        <a href="{{ route('student_dashboard') }}">
                            <i class='bx bx-home icon' ></i>
                            <span class="text nav-text">Content Library</span>
                        </a>
                    </li>
                    <li class="nav-links" id="">
                        <a href="{{ route('student_dashboard') }}">
                            <i class='bx bx-home icon' ></i>
                            <span class="text nav-text">Subscribed Educators</span>
                        </a>
                    </li>
                    <li class="nav-links" id="">
                        <a href="{{ route('student_dashboard') }}">
                            <i class='bx bx-home icon' ></i>
                            <span class="text nav-text">Assessments</span>
                        </a>
                    </li>
                    <li class="nav-links" id="">
                        <a href="{{ route('student_dashboard') }}">
                            <i class='bx bx-home icon' ></i>
                            <span class="text nav-text">Progress Report</span>
                        </a>
                    </li>
                    <li class="nav-links" id="">
                        <a href="{{ route('student_dashboard') }}">
                            <i class='bx bx-home icon' ></i>
                            <span class="text nav-text">Progress Charts</span>
                        </a>
                    </li>
                    <li class="nav-links" id="">
                        <a href="{{ route('student_dashboard') }}">
                            <i class='bx bx-home icon' ></i>
                            <span class="text nav-text">Achievements</span>
                        </a>
                    </li>
                    <li class="nav-links" id="">
                        <a href="{{ route('student_dashboard') }}">
                            <i class='bx bx-home icon' ></i>
                            <span class="text nav-text">Communication</span>
                        </a>
                    </li>
                    <li class="nav-links" id="">
                        <a href="{{ route('student_dashboard') }}">
                            <i class='bx bx-home icon' ></i>
                            <span class="text nav-text">Notifications</span>
                        </a>
                    </li>
                    <li class="nav-links" id="">
                        <a href="{{ route('student_dashboard') }}">
                            <i class='bx bx-home icon' ></i>
                            <span class="text nav-text">Subscriptions</span>
                        </a>
                    </li>
                    <li class="nav-links" id="">
                        <a href="{{ route('student_dashboard') }}">
                            <i class='bx bx-home icon' ></i>
                            <span class="text nav-text">Payments Record</span>
                        </a>
                    </li>
                    <li class="nav-links" id="">
                        <a href="{{ route('student_dashboard') }}">
                            <i class='bx bx-home icon' ></i>
                            <span class="text nav-text">Profile</span>
                        </a>
                    </li>
                    <li class="nav-links" id="">
                        <a href="{{ route('student_dashboard') }}">
                            <i class='bx bx-home icon' ></i>
                            <span class="text nav-text">Settings</span>
                        </a>
                    </li>
                    <li class="nav-links" id="">
                        <a href="{{ route('student_dashboard') }}">
                            <i class='bx bx-home icon' ></i>
                            <span class="text nav-text">About Us</span>
                        </a>
                    </li>
                    <li class="nav-links" id="">
                        <a href="{{ route('student_dashboard') }}">
                            <i class='bx bx-home icon' ></i>
                            <span class="text nav-text">Contact Us</span>
                        </a>
                    </li>
                    <li class="nav-links" id="">
                        <a href="{{ route('student_dashboard') }}">
                            <i class='bx bx-home icon' ></i>
                            <span class="text nav-text">Customization</span>
                        </a>
                    </li>
                    <li class="nav-links" id="">
                        <a href="{{ route('student_dashboard') }}">
                            <i class='bx bx-home icon' ></i>
                            <span class="text nav-text">My schedule</span>
                        </a>
                    </li>
                    <li class="nav-links" id="">
                        <a href="{{ route('student_dashboard') }}">
                            <i class='bx bx-home icon' ></i>
                            <span class="text nav-text">Calendar</span>
                        </a>
                    </li>
                    <li class="nav-links" id="">
                        <a href="{{ route('student_dashboard') }}">
                            <i class='bx bx-home icon' ></i>
                            <span class="text nav-text">Help & Support</span>
                        </a>
                    </li>
                    <li class="nav-links" id="">
                        <a href="{{ route('student_dashboard') }}">
                            <i class='bx bx-home icon' ></i>
                            <span class="text nav-text">Logout</span>
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
                    <a href="{{ route('lrs') }}">
                        <i class='bx bx-log-out-circle icon' ></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>
            </div>
        </div>
    </nav>