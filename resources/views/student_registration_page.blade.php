<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCOREASY | Student Registration</title>
    <link rel="stylesheet" href="{{ asset('cssfiles/student_registration_page.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="container">
        <div class="login-link">
            <div class="logo">
                <i class='bx bxs-objects-vertical-bottom'></i>
                <span class="text">SCOREASY</span>
            </div>
            <p class="side-big-headning">Already a member?</p>
            <p class="primary-bg-text">To keep track on your<br>dashboard, please login with<br>your personal info</p>
            <a href="{{ route('student_login_page') }}" class="loginbtn">Login</a>
        </div>
        <form action="{{ route('student_registration_form_submission_route') }}" method = "post" class="signup-form-container" enctype="multipart/form-data">
            @csrf
            <p class="big-headning">Create Account</p>
            <div class="social-media-platform">
                <a href="#"><i class='bx bx-sm bxs-objects-vertical-bottom'></i></a>
                <a href="#"><i class='bx bx-sm bxs-objects-vertical-bottom'></i></a>
                <a href="#"><i class='bx bx-sm bxs-objects-vertical-bottom'></i></a>
            </div>
            <div class="progress-bar">
                <div class="stage">
                    <p class="tool-tip">Personal Info</p>
                    <p class="stageno stageno-1">1</p>
                </div>
                <div class="stage">
                    <p class="tool-tip">Un & Ps</p>
                    <p class="stageno stageno-2">2</p>
                </div>
                <div class="stage">
                    <p class="tool-tip">Submission</p>
                    <p class="stageno stageno-3">3</p>
                </div>
            </div>
            <div class="signup-form-content">
                <div class="stage1-content">
                    <div class="button-container">
                        <div class="text-fields name">
                            <label for="name"><i class='bx bx-user-circle' style='color:#6487cb'></i></label>
                            <input type="text" name="name" id="name" placeholder="Your full name" required>
                        </div>
                        <div class="text-fields email">
                            <label for="email"><i class='bx bx-envelope' style='color:#6487cb'></i></label>
                            <input type="text" name="email" id="email" placeholder="Your email address" required>
                        </div>
                    </div>
                    <div class="button-container">
                        <div class="text-fields phone_no">
                            <label for="phone_no"><i class='bx bx-phone-call' style='color:#6487cb'></i></label>
                            <input type="text" name="phone_no" id="phone_no" placeholder="Phone number with +91" required>
                        </div>
                        <div class="text-fields date_of_birth">
                            <label for="date_of_birth"><i class='bx bx-calendar-event' style='color:#6487cb' ></i></label>
                            <input type="date" name="date_of_birth" id="date_of_birth" required>
                        </div>
                    </div>
                    <div class="pagination-btns">
                        <input type="button" value="Previous" class="previouspage stagebtn1a">
                        <input type="button" value="Next" class="nextpage stagebtn1b" onclick = "stage1to2()">
                    </div>
                </div>
                <div class="stage2-content">
                    <div class="button-container">
                        <div class="text-fields username" style = "width: 290px;">
                            <label for="username"><i class='bx bxs-user' style='color:#6487cb'></i></label>
                            <input type="text" name="username" id="username" placeholder="Create Own Username" required>
                        </div>
                        <div class="text-fields password" style = "width: 290px;">
                            <label for="password"><i class='bx bxs-key' style='color:#6487cb' ></i></label>
                            <input type="password" name="password" id="password" placeholder="Create Own Password" required>
                            <img src="{{ asset('img/eye-close.png') }}" alt="eye-pic" class = "eye_icon" id = "eyeIcon">
                        </div>
                    </div>
                    <div class="button-container">
                        <div class="text-fields confirm_password khaskao" >
                            <label for="confirm_password"><i class='bx bxs-check-shield' style='color:#6487cb' ></i></label>
                            <input type="password" name="confirm_password" id="confirm_password" placeholder="Enter Password Again" required>
                            <img src="{{ asset('img/eye-close.png') }}" alt="eye-pic" class = "eye_icon" id = "eyeIcon2">
                        </div>
                    </div> 
                    <div class="pagination-btns">
                        <input type="button" value="Previous" class="previouspage stagebtn2a" onclick = "stage2to1()">
                        <input type="button" value="Next" class="nextpage stagebtn2b" onclick = "stage2to3()">
                    </div>
                </div>
                <div class="stage3-content">
                    <div class="tc-container">
                        <label for="tc" class="tc">
                            <input type="checkbox" name="tc" id="tc" required>
                            By submitting your details, you agree to the <a href="#">terms and conditions</a>
                        </label>
                    </div>
                    <br>
                    <div class="pagination-btns">
                        <input type="button" value="Previous" class="previouspage stagebtn5a" onclick = "stage3to2()">
                        <input type="submit" value="Submit" class="nextpage stagebtn5b">
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
<script>
    let eye_icon = document.getElementById("eyeIcon");
    let eye_icon2 = document.getElementById("eyeIcon2");
    let password = document.getElementById("password");
    let c_password = document.getElementById("confirm_password");

    eye_icon.onclick = function (){
        if(password.type == "password"){
            password.type = "text";
            // eye_icon.src = "{{ asset('img/eye-open.png') }}";
            eye_icon.src = "{{ asset('img/blue_eye_open_icon.png') }}";
        }else{
            password.type = "password";
            eye_icon.src = "{{ asset('img/eye-close.png') }}";
        }
    }

    eye_icon2.onclick = function (){
        if(c_password.type == "password"){
            c_password.type = "text";
            // eye_icon2.src = "{{ asset('img/eye-open.png') }}";
            eye_icon2.src = "{{ asset('img/blue_eye_open_icon.png') }}";
        }else{
            c_password.type = "password";
            eye_icon2.src = "{{ asset('img/eye-close.png') }}";
        }
    }

</script>
<script src="{{ asset('js/student_registration_page.js') }}"></script>
<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
</html>