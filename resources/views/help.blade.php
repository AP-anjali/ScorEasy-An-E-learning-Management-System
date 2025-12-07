<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help</title>
    <link rel="stylesheet" href="{{ asset('cssfiles/menustyle.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        .goback {
            position: absolute;
            bottom: 40px;
            left: 90px;
            transform: translateX(-50%);
            /* text-align: center; */
            z-index: 9999; 
        }

        .goback a {
            text-decoration: none;
            color: #fff;
            /* font-weight: bold; */
            font-size: 18px;
            cursor: pointer;
        }

        .goback a:hover {
            color: #0ef;
            text-decoration: underline;
        }

    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navdiv">
            <div class="logo"><i><a href="{{ route('home') }}">SCOREASY</a></i></div>
            <ul class="menu">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('about') }}">About Us</a></li>
                <li><a href="{{ route('contact') }}">Contact Us</a></li>
                <li><a href="{{ route('lrs') }}">Sign In/Sign Up</a></li>
                <li><a href="{{ route('lrf') }}">Become a tutor</a></li>
                <li><a href="{{ route('help') }}">Help&nbsp;<i class='bx bx-question-mark'></i></a></li>
            </ul>
        </div>
    </nav>

    <div class="aadu" style="margin-top:100px">
        <span class="one animate-left">Some Guidance :</span><br><br>
        <span class="one animate-left"><p style="display:inline; font-size:26px;">- Home: Main page of our Website<br>- About Us: Visit this page for know about us<br>- Contact Us: visit this page for contact with us<br>- Sing In/Sing Up: Page for Login or Register Yourself</p></span><br><br><br>
        <span class="one animate-left"><p style="display:inline; font-size:20px; font-weight: lighter; margin-left:30px;">If you have any another issue, Send mail on :</p><p style="display:inline; font-size:22px; font-weight: lighter; margin-left:30px; border-bottom: 1px solid #0ef;">anjalipatel3074@gmail.com</p></span>
    </div>
    <img id="sliding-image-b" class="contact" src="{{ asset('img/help.png') }}" alt="photu he bhai">
    <div class="goback" style="margin-top: 20px;">
        <br>
        <a href="{{ route('home') }}">&lt;&lt;&nbsp;Go Back</a>
    </div>
    <script>
        window.addEventListener('load', function () {
            var img = document.getElementById('sliding-image-b');
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
</body>
</html>