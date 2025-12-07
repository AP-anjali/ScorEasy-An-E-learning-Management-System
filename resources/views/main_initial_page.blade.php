<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>SCOREASY | Home</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
   <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
   <link rel="stylesheet" href="{{ asset('cssfiles/main_initial_page.css') }}">
   <style>
        @if(isset($heroImage) && $heroImage && $heroImage->hero_image)
            .my_hero_section {
                background-image: url('{{ asset('storage/' . $heroImage->hero_image) }}') !important;
            }
        @else
            .my_hero_section{
                background-image: url('{{ asset('img/img_instead_of_hero_image.jpg') }}') !important;
                background-color: #f0f0f0;
            }
        @endif
        
        .my_hero_section{
            width: 100%;
            height: 500px;
            display: flex;
            background-size: cover;
            justify-content: center;
            align-items: flex-end;
            margin-top: 2px;
        }
        .searched_data_not_available_text{
            text-align: center; 
            margin-top: 20px; 
            color: #454545;
        }

        .container h2{
            margin-top: 20px;
            margin-bottom: 10px;
            text-align: center;
            font-size: 28px;
            color: #454545;
        }
        .container{
            background: pink;
            border-radius: 8px;
            margin: 0 200px;
            padding-top: 20px;
            padding-bottom: 10px;
            text-align: center;
        }

        #nothing_to_show_here_img{
            height: 500px;
            border-radius: 20px;
            border: 1px solid rgba(0,0,0,.2);
            box-shadow: 5px 5px 5px rgba(0,0,0,.2);
            margin-top: 20px;
        }
    </style>
</head>
<body class = "active">

@include('website_menu')

<div class="my_hero_section">
    <div class="hero_msg">
        <p>A Warm Welcome To All Of You In Our Family, Your Presence Is Our Priority! &nbsp;&nbsp;&nbsp;&nbsp;<a href="#">Click Here To Get To Know Us</a></p>
    </div>
</div>

<section class="teachers">
   <h1 class="heading" style = "margin-top: 20px; margin-bottom: 30px;">SCOREASY Subscriptions... !</h1>
</section>

<div class="contact_us_and_logo_container">
        <div class="custom_contact_us_container">
            <h3 id = "contact_us_heading">Check Subscriptions</h3>
            <p id = "contact_us_description">Discover exclusive benefits with our subscription plans! Unlock unlimited access to premium content, personalized learning paths, and expert support. <br><span style = "font-weight: 700; text-decoration: underline;">Elevate your learning experience today!</span></p>
            <a href="{{ route('showing_all_Subscriptions_at_main_page') }}" target = "_blank" id = "mail_us_link"><div class="contact_us_btn">Check It Now</div></a>
        </div>
        <div class="custom_scoreasy_logo_container">
            <img src="{{ asset('img/scoreasy_logo_contact_us.png') }}" id = "scoreasy_logo_contact_us" alt="">
        </div>
</div>

<section class="teachers">
   <h1 class="heading" style = "margin-top: 45px; margin-bottom: -30px;">Quick Search... !</h1>
</section>

<div id = "my_small_boxes" class = "section_he_bhai">
    <a href="{{ route('showing_only_UPSC_content') }}">
        <div class="my_category_box">
            <img src="{{ asset('img/upsc_logo_for_boxes-removebg-preview.png') }}" style = "height: 80px;" alt="category section image">
            <h6>UPSC Tutorials</h6>
        </div>
    </a>

    <a href="{{ route('showing_only_GPSC_content') }}">
        <div class="my_category_box">
            <img src="{{ asset('img/gpsc_logo_for_boxes.png') }}" style = "height: 80px;" alt="category section image">
            <h6>GPSC Tutorials</h6>
        </div>
    </a>

    <a href="{{ route('showing_all_video_tutorials_at_main_page') }}">
        <div class="my_category_box">
            <img src="{{ asset('img/video_icon_for_layer_resized.png') }}" style = "height: 80px;" alt="category section image">
            <h6>Videos Tutorials</h6>
        </div>
    </a>
    
    <a href="{{ route('showing_all_PDF_tutorials_at_main_page') }}">
        <div class="my_category_box">
            <img src="{{ asset('img/pdf_icon_for_layer_resized.png') }}" style = "height: 80px;" alt="category section image">
            <h6>PDFs Tutorials</h6>
        </div>
    </a>

    <a href="{{ route('UPSC_Old_Exam_Papers') }}">
        <div class="my_category_box" style = "width: 200px;">
            <img src="{{ asset('img/pdf_icon_for_layer_resized.png') }}" style = "height: 80px; width: 80px;" alt="category section image">
            <h6>UPSC Old Exam Papers</h6>
        </div>
    </a>

    <a href="{{ route('GPSC_Old_Exam_Papers') }}">
        <div class="my_category_box" style = "width: 200px;">
            <img src="{{ asset('img/pdf_icon_for_layer_resized.png') }}" style = "height: 80px; width: 80px;" alt="category section image">
            <h6>GPSC Old Exam Papers</h6>
        </div>
    </a>
</div>

<!-- ====================================== video content ======================================================== -->

<section class="teachers">
   <h1 class="heading" style = "margin-top: 20px; margin-bottom: 30px;">Video Content !</h1>
</section>

<div class="web_video_list_container">
    <div class="image_check">
        <img src="{{ asset('img/video_tutorial_banner_image_custome.jpg') }}" alt="">
    </div>
    <div class="under_line"></div>

    <section class="teachers">
        <div class="search-tutor" style = "margin-top: 20px; border: 1px solid rgba(0,0,0,.2); box-shadow: 5px 5px 5px rgba(0,0,0,.2);">
            <input type="text" id="searchBox" name="search_box" placeholder="Search Video Tutorial..." required maxlength="200" oninput="filterVideos()">
            <button type="submit" class="fas fa-search" name="search_tutor"></button>
        </div>
    </section>

    <h1 id = "noDataMessage" class = "searched_data_not_available_text"></h1>

    <div class="main_initial_page_videos_container">
        <div class="web_video_tutorials_container" style="margin-top: 10px;">
            @if(count($all_video_tutorial) > 0)
                @foreach($all_video_tutorial as $each_video_tutorial)  
                    <div class="web_each_video" style="display: flex; flex-direction: column; width: 400px;">
                        <div class="effect_content_container">
                            <div class="video_image_mamma">
                                <a href="#"><img src="{{ asset('storage/' . $each_video_tutorial->video_tutorial_Thumbnail_Image) }}" style="height: 200px; width: 320px; " class="video_thumbnail_image" alt="video_tutorial_Thumbnail_Image"></a>
                            </div>
                            <a href="{{ route('video', $each_video_tutorial->id) }}" target="_blank">
                                <div class = "effect_content">
                                    <img src="{{ asset('img/video_icon_for_layer_resized.png') }}" alt="video icon">
                                    <p id="effect_text">Video Tutorial</p>
                                </div>
                            </a>
                        </div>

                        <div class="other_container">
                            <div class="web_each_video_info flex_style"> 
                                <a href=""><img src="{{ asset('storage/' . $each_video_tutorial->faculty->profile_pic) }}" alt="faculty chanel profile pic" style="height: 40px; border-radius: 50%;" class="faculty_profile_pic"></a>
                                <div class="video_other_info">
                                    <a href="{{ route('video', $each_video_tutorial->id) }}" target="_blank">{{$each_video_tutorial->video_tutorial_title}}</a>
                                    <a href="#"><p id="faculty_name">{{$each_video_tutorial->faculty->name}}</p></a>
                                    <p>18k Views &bull; 20 Days Ago</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="container">
                    <img src="{{ asset('img/nothing_to_show_here.png') }}" id="nothing_to_show_here_img" alt="nothing to show here">
                    <h2>No any Video uploaded yet</h2>
                </div>
            @endif

            @if(count($all_video_tutorial) > 15)
                <a href="{{ route('showing_all_video_tutorials_at_main_page') }}" id = "arrow_btn_link"><div class="show_all_video_tutorial_btn"><span id = "arrow_text">Show All</span><i class="fa-solid fa-right-long" id = "arrow_icon"></i></div></a>
            @endif
        </div>
    </div>
</div>


<!-- ====================================== PDF content ======================================================== -->

<section class="teachers">
   <h1 class="heading" style = "margin-top: 100px; margin-bottom: 30px;">PDF Content !</h1>
</section>

<div class="web_video_list_container">
    <div class="image_check">
        <img src="{{ asset('img/PDF_tutorial_banner_image_hehe.jpg') }}" alt="">
    </div>
    <div class="under_line"></div>

    <section class="teachers">
        <div class="search-tutor" style = "margin-top: 20px; border: 1px solid rgba(0,0,0,.2); box-shadow: 5px 5px 5px rgba(0,0,0,.2);">
            <input type="text" id="searchBox2" name="search_box" placeholder="Search PDF Tutorial..." required maxlength="200" oninput="filterpdfs()">
            <button type="submit" class="fas fa-search" name="search_tutor"></button>
        </div>
    </section>

    <h1 id = "noDataMessage2" class = "searched_data_not_available_text"></h1>

    <div class="main_initial_page_PDFs_container">
        <div class="web_video_tutorials_container" style="margin-top: 10px;">
            @if(count($all_PDF_tutorial) > 0)
                @foreach($all_PDF_tutorial as $each_pdf_tutorial)  
                    <div class="web_each_video class_for_search_box" style="display: flex; flex-direction: column; width: 400px;">
                        <div class="effect_content_container2">
                            <div class="video_image_mamma">
                                <a href="#"><img src="{{ asset('storage/' . $each_pdf_tutorial->PDF_tutorial_Thumbnail_Image) }}" style="height: 200px; width: 320px; " class="video_thumbnail_image" alt="PDF_tutorial_Thumbnail_Image"></a>
                            </div>
                            <a href="{{ route('PDF', $each_pdf_tutorial->id) }}" target="_blank">
                                <div class = "effect_content2">
                                    <img src="{{ asset('img/pdf_icon_for_layer_resized.png') }}" alt="PDF icon">
                                    <p id="effect_text">PDF Tutorial</p>
                                </div>
                            </a>
                        </div>

                        <div class="other_container">
                            <div class="web_each_video_info flex_style">
                                <a href=""><img src="{{ asset('storage/' . $each_pdf_tutorial->faculty2->profile_pic) }}" alt="faculty chanel profile pic" style="height: 40px; border-radius: 50%;" class="faculty_profile_pic"></a>
                                <div class="video_other_info">
                                    <a href="{{ route('PDF', $each_pdf_tutorial->id) }}" target="_blank">{{$each_pdf_tutorial->PDF_tutorial_title}}</a>
                                    <a href="#"><p id="faculty_name">{{$each_pdf_tutorial->faculty2->name}}</p></a>
                                    <p>18k Views &bull; 20 Days Ago</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="container">
                    <img src="{{ asset('img/nothing_to_show_here.png') }}" id="nothing_to_show_here_img" alt="nothing to show here">
                    <h2>No any PDF uploaded yet</h2>
                </div>
            @endif

            @if(count($all_PDF_tutorial) > 15)
                <a href="{{ route('showing_all_PDF_tutorials_at_main_page') }}" id = "arrow_btn_link2"><div class="show_all_video_tutorial_btn"><span id = "arrow_text2">Show All</span><i class="fa-solid fa-right-long" id = "arrow_icon2"></i></div></a>
            @endif
        </div>
    </div>
</div>

@if(session('showAdminLoginAlert'))
    <script>
        alert('To access further pages, please login first \nDo Not Mess With Administration Area ... 😠');
        {!! session()->forget('showAdminLoginAlert') !!}
    </script>
@endif



@include('website_footer')

<script src="{{ asset('js/main_initial_page.js') }}"></script>

<script>
    
    var noDataMessage = document.getElementById('noDataMessage');
    noDataMessage.style.display = "none";

    var noDataMessage2 = document.getElementById('noDataMessage2');
    noDataMessage2.style.display = "none";

    function filterVideos() {
        var input, filter, videos, videoContainer, videoTitle, i, txtValue;
        input = document.getElementById('searchBox');
        filter = input.value.toUpperCase();
        videoContainer = document.getElementsByClassName('web_each_video');
        var matchingVideosExist = false; 

        // Loop through all videos, hide those that don't match the search query
        for (i = 0; i < videoContainer.length; i++) {
            videoTitle = videoContainer[i].getElementsByTagName("a")[3]; // Assuming the fourth 'a' tag contains the title
            if (videoTitle) {
                txtValue = videoTitle.textContent || videoTitle.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    videoContainer[i].style.display = "";
                    matchingVideosExist = true; 
                } else {
                    videoContainer[i].style.display = "none";
                }
            }
        }

        // Check if there are no matching videos, display a message
        
        if (!matchingVideosExist) {
            if (noDataMessage) {
                noDataMessage.style.display = "block";
                noDataMessage.innerText = 'Sorry, no data available for "' + input.value + '"';
            }
        } else {
            if (noDataMessage) {
                noDataMessage.style.display = "none";
            }
        }
    }

    function filterpdfs() {
        var input2, filter2, pdfs, pdfContainer, pdfTitle, j, txtValue2;
        input2 = document.getElementById('searchBox2');
        filter2 = input2.value.toUpperCase();
        pdfContainer = document.querySelectorAll('.web_each_video.class_for_search_box');
        var matchingPdfsExist = false; 

        // Loop through all videos, hide those that don't match the search query
        for (j = 0; j < pdfContainer.length; j++) {
            pdfTitle = pdfContainer[j].getElementsByTagName("a")[3]; // Assuming the fourth 'a' tag contains the title
            if (pdfTitle) {
                txtValue2 = pdfTitle.textContent || pdfTitle.innerText;
                if (txtValue2.toUpperCase().indexOf(filter2) > -1) {
                    pdfContainer[j].style.display = "";
                    matchingPdfsExist = true; 
                } else {
                    pdfContainer[j].style.display = "none";
                }
            }
        }

        // Check if there are no matching videos, display a message
        
        if (!matchingPdfsExist) {
            if (noDataMessage2) {
                noDataMessage2.style.display = "block";
                noDataMessage2.innerText = 'Sorry, no data available for "' + input2.value + '"';
            }
        } else {
            if (noDataMessage2) {
                noDataMessage2.style.display = "none";
            }
        }
    }
</script>
</body>
</html>