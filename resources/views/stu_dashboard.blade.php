<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="{{ asset('cssfiles/menustyle.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        .dropdown-menu {
            display: none;
            position: absolute;
            background: #081b29;
            border: 2px solid #0ef;
            box-shadow: 0 0 10px #0ef;  
            width: 200px;
            height: 70px;
            padding:10px 0 4px 12px;
            margin-top:2px;
        }

        .dropdown-menu li {
            display: block;
            margin-top : 5px;
        }

        .dropdown-menu li i{
            display: inline;
            margin-top : 5px;
            border:none;
        }

        .dropdown-menu li:hover{
            color: #fff;
        }

        /* .dropdown:hover .dropdown-menu {
            display: block;
        } */
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navdiv">
            <div class="logo"><i><a href="{{ route('home') }}">SCOREASY</a></i></div>
            <ul class="menu">
                <li><a href="{{ route('stu_dashboard') }}">Home</a></li>
                <li><a href="{{ route('about') }}">About Us</a></li>
                <li><a href="{{ route('contact') }}">Contact Us</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle">Account&nbsp;<i class='bx bxs-user'></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('cp') }}"><i class='bx bxs-key'></i>&nbsp;Change Password</a></li>
                        <li><a href="{{ route('lrs') }}"><i class='bx bx-power-off'></i>&nbsp;Logout</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('help') }}">Help&nbsp;<i class='bx bx-question-mark'></i></a></li>
            </ul>
        </div>
    </nav><br><br>
    <h1 style="color: white;" class="animate-left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Welcome In Our Application</h1>
    <img id="sliding-image" class="contact" src="{{ asset('img/dash1.png') }}" alt="photu he bhai" style="margin:-10px 0 0 800px; border-bottom:2px solid #0ef; height:350px; width:450px;">
    <script>
        window.addEventListener('load', function () {
            var img = document.getElementById('sliding-image');
            img.style.animation = 'slideDown 1s ease-in-out';
        });
    </script>
    <script>
        window.addEventListener('load', function () {
            var spans = document.querySelectorAll('.animate-left');
            spans.forEach(function (span) {
                span.style.animation = 'slideLeft 1s ease-in-out';
            });
        });
    </script>

    <script>
    const dropdown = document.querySelector('.dropdown');
    const dropdownMenu = document.querySelector('.dropdown-menu');

    dropdown.addEventListener('mouseover', function () {
        dropdownMenu.style.display = 'block';
    });

    dropdown.addEventListener('mouseout', function () {
        dropdownMenu.style.display = 'none';
    });
    </script>
</body>
</html>