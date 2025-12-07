<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-learning login & registration</title>
    <link rel="stylesheet" href="{{ asset('cssfiles/style1.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="cover">
        <span class="trikon-bg"></span>
        <span class="trikon-bg2"></span>

        <div class="form-box login">
            <h2 class="animation" style="--i:0; --j:21;">Login</h2>
            <form action="{{ route('loginuser') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="input-box input-boxy animation" style="--i:1; --j:22;">
                    <input type="text" name="username" id="myInput3" placeholder="Enter Your Username" onfocus="showPlaceholder3()" required>
                    <label>Username</label>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box input-boxy animation" style="--i:2; --j:23;">
                    <input type="password" name="password" id="myInput4" placeholder="Enter Your password" onfocus="showPlaceholder4()" required>
                    <label>password</label>
                    <i class='bx bxs-lock-alt'></i>
                </div>
                <button type="submit" class="loginbtn animation" style="--i:3; --j:24;">Login</button>
                <div class="link animation" style="--i:4; --j:25;">
                    <p>Don't have an Account? <a href="#" class="register-link">Sign Up</a></p>
                </div>
            </form>
        </div>
        <div class="info-text login">
            <h2 class="animation" style="--i:0; --j:20;">Welcome Back!</h2><br>
            <p class="animation" style="--i:1; --j:21;">To learning environment...</p><br>
            <p class="animation" style="--i:2; --j:22;"><u>Unlocking Knowledge</u></p>
        </div>

        <div class="form-box register">
            <h2 class="animation" style="--i:17; --j:0;">Sign Up</h2>
            <form action="{{ route('datainsert') }}" method="post" enctype="multipart/form-data" class="test">
                @csrf
                    <div class="input-box input-boxx animation test" style="--i:18; --j:1;">
                        <input type="text" name="name" id="myInput5" placeholder="Enter Your Name" onfocus="showPlaceholder5()" required>
                        <label>Name</label>
                        <i class='bx bxs-user'></i>
                    </div>
                    <div class="input-box input-boxx animation test" style="--i:18; --j:1;">
                        <input type="text" name="email" id="myInput6" placeholder="Enter Your Email Address" onfocus="showPlaceholder6()" required>
                        <label>Email ID</label>
                        <i class='bx bxs-user'></i>
                    </div>
                    <div class="input-box input-boxx animation test" style="--i:18; --j:1;">
                        <input type="text" name="username" id="myInput" placeholder="Create your Unique Username" onfocus="showPlaceholder()" required>
                        <label>Username</label>
                        <i class='bx bxs-user'></i>
                    </div>
                    <div class="input-box input-boxx animation test" style="--i:19; --j:3;">
                        <input type="password" name="password" id="myInput1" placeholder="Create your Strong Password" onfocus="showPlaceholder1()" required>
                        <label>Password</label>
                        <i class='bx bxs-lock-alt'></i>
                    </div>
                    <div class="input-box input-boxx animation test" style="--i:20; --j:3;">
                        <input type="password" name="confirm_password" id="myInput2" placeholder="Enter password again" onfocus="showPlaceholder2()" required>
                        <label>Confirm Password</label>
                        <i class='bx bxs-lock-alt'></i>
                    </div>
                <button type="submit" class="loginbtn animation" style="--i:21; --j:4;">Sign Up</button>
                <div class="link animation" style="--i:22; --j:5;">
                    <p>Already have an Account? <a href="#" class="login-link">Login</a></p>
                </div>
            </form>
        </div>
        <div class="info-text register">
            <h2 class="animation" style="--i:17; --j:0;">Welcome!</h2><br>
            <p class="animation" style="--i:18; --j:1;">Step into the world of "Education"...</p>
        </div>
    </div>

    <div class="goback" style="margin-top: 20px;">
        <br>
        <a href="{{ route('home') }}">&lt;&lt;&nbsp;Go Back</a>
    </div>

    <script src="{{ asset('js/script.js') }}"></script>

</body>
</html>