<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Change</title>
    <link rel="stylesheet" href="{{ asset('cssfiles/cp_style.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="cover">
        <span class="trikon-bg hide-element"></span>
        <span class="trikon-bg2"></span>

        <div class="form-box register"><br>
            <h2 class="animation" style="--i:17; --j:0;">Change Password</h2>
            <form action="{{ route('changepassword') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="input-box animation" style="--i:18; --j:1;">
                    <input type="text" name="username" id="myInput" placeholder="Enter Your Username" onfocus="showPlaceholder()" required>
                    <label>Username</label>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box animation" style="--i:19; --j:3;">
                    <input type="password" name="password" id="myInput1" placeholder="Enter Your password" onfocus="showPlaceholder1()" required>
                    <label>Password</label>
                    <i class='bx bxs-lock-alt'></i>
                </div>
                <div class="input-box animation" style="--i:19; --j:3;">
                    <input type="password" name="n_password" id="myInput2" placeholder="Create New Strong Password" onfocus="showPlaceholder2()" required>
                    <label>New Password</label>
                    <i class='bx bxs-key'></i>
                </div>
                <div class="input-box animation" style="--i:20; --j:3;">
                    <input type="password" name="confirm_password" id="myInput3" placeholder="Enter New password again" onfocus="showPlaceholder3()" required>
                    <label>Confirm New Password</label>
                    <i class='bx bxs-lock-alt'></i>
                </div>
                <button type="submit" class="loginbtn animation" style="--i:21; --j:4;">Change Password</button>
                <div class="link animation" style="--i:22; --j:5;">
                    <p>Don't want to change Password?&nbsp;<a href="{{ route('stu_dashboard') }}" class="login-link">Go back</a></p>
                </div>
            </form>
        </div>
        <div class="info-text register">
            <h2 class="animation" style="--i:17; --j:0;">Hey there...!</h2><br><br>
            <p class="animation" style="--i:18; --j:1;">Want to change your current Password..?</p><br>
            <p class="animation" style="--i:18; --j:1;">Fill up this Form...&nbsp;<i class='bx bxs-hand-right'></i></p>
        </div>
    </div>

    <script src="{{ asset('js/cp.js') }}"></script>

</body>
</html>