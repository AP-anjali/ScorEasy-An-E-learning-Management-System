<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>SCOREASY | ABOUT US</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css" integrity="sha512-OTcub78R3msOCtY3Tc6FzeDJ8N9qvQn1Ph49ou13xgA9VsH9+LRxoFU6EqLhW4+PKRfU+/HReXmSZXHEkpYoOA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
   <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
   <link rel="stylesheet" href="{{ asset('cssfiles/main_initial_page.css') }}">
   <style>
        #main-pic{
            margin-left: 10%;
            margin-top: 5px;
        }
        .clg_logo{
            height: 180px;
        }
        .bpccs{
            margin-left: 65%;
        }
        .about_text{
            font-size: 14px;
            padding : 0 50px;
            color: #454545;
        }
        .about_text h1{
            text-align: justify;
            margin-top: 35px;
        }
   </style>
</head>
<body class = "active">

@include('website_menu')


<section class="contact">

    <div class="customer_account_second_part_main_container" id = "secured_data_that_need_user_verification_for_account_deletion">
        <img src="{{ asset('img/anjali_pics/KSV.png') }}" alt="KSV" class = "clg_logo">
        <img src="{{ asset('img/anjali_pics/BPCCS.png') }}" alt="BPCCS" class = "clg_logo bpccs">

        <div class="about_text">
            <h1>Welcome to [SCOREASY], a digital platform dedicated to revolutionizing the way knowledge is acquired and shared. Our journey began with a vision to democratize education and make learning accessible to all, irrespective of geographical barriers. At [SCOREASY], we believe in the transformative power of education and its ability to shape individuals and communities.</h1>
            <h1>Our mission is to provide high-quality educational resources that inspire, engage, and empower learners of all ages. From interactive courses to informative articles and engaging multimedia content, we strive to cater to diverse learning styles and preferences. Our team of passionate educators and experts work tirelessly to curate content that is both informative and enriching.</h1>
            <h1>We understand that learning is a lifelong journey, and we are committed to supporting our users every step of the way. Whether you're a student, educator, or lifelong learner, [SCOREASY] is your go-to destination for knowledge and skill enhancement.</h1>
            <h1>Join us as we embark on this educational adventure, where learning knows no bounds. Together, let's unlock the boundless potential of education and pave the way for a brighter future.</h1>
            <h1 style = "font-size: 16px; color: #878787; text-align: center;">MADE WITH &#10084; BY ANJALI PATEL</h1>
        </div>

    </div>

    <div class="customer_account_main_container">
        <img src="{{ asset('img/anjali_pics/name.png') }}" alt="photo" id = "main-pic">
        <h1 style = "font-size: 16px; color: #878787; text-align: center; margin-top: 20px;">anjalipatel3074@gmail.com <span style = "margin-left: 20px;">|</span> <span style = "margin-left: 20px;">+917046106554</span> </h1>
    </div>

</section>

@include('website_footer')

<script src="{{ asset('js/main_initial_page.js') }}"></script> 
</body>
</html>