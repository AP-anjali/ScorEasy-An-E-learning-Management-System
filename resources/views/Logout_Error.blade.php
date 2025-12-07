<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('cssfiles/Logout_Error.css') }}" />
    <title>Logout Error</title>
</head>
<body>
    <div class="container">

        @if(session('showStudentLogoutAlert'))
                <script>
                    alert('To access further pages, please logout first From your current account');
                </script>
                {!! session()->forget('showStudentLogoutAlert') !!}
        @endif

        @if(session('showFacultyLogoutAlert'))
                <script>
                    alert('To access further pages, please logout first From your current account');
                </script>
                {!! session()->forget('showFacultyLogoutAlert') !!}
        @endif

        @if(session('showAdminLogoutAlert'))
                <script>
                    alert('To access further pages, please logout first From your current account');
                </script>
                {!! session()->forget('showAdminLogoutAlert') !!}
        @endif
    
        <!-- <button type = "submit" class = "btn" onclick = "openPopUp()">Test</button> -->
        <div class="popup" id= "popUpArea">
            <img src="{{ asset('img/cross_mark.png') }}" alt="tick image" id="logout_popup">
            <h2>Sorry !</h2>
            <p style = "margin-top:10px;">You have to logout form your Account<br>for further process...Please Cooperate<br>Thanks !</p>
            <button type = "submit" onclick = "goback()">Okay</button>
        </div>
    </div>

    <script>
        let popup = document.getElementById("popUpArea");

        window.onload = function() {
            popup.classList.add("open_popup");
        }

        // function openPopUp(){
        //     popup.classList.add("open_popup");
        // }

        function goback(){
            window.location.replace("/");
        }
    </script>
</body>
</html>