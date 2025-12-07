<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>SCOREASY | All Video Content</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
   <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
   <link rel="stylesheet" href="{{ asset('cssfiles/main_initial_page.css') }}">
   <style>
        .web_video_list_container{
            padding-left: 2%;
            padding-right: 2%;
            padding-bottom: 20px;
        }
        .image_check{
            width: 100%;
        }
        .image_check img{
            width: 50%;
            border-radius: 6px;
            margin-left: 25%;
        }
        .under_line{
            border-bottom: 1px solid rgba(0,0,0,.2);
            width: 60%;
            margin-left: 20%;
            margin-top: 20px;
        }
        .flex_style{
            display: flex;
            align-items: center;
        }
        .flex_style1{
            display: flex;
            align-items: center;
        }

        .web_video_tutorials_container{
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            grid-column-gap: 16px;
            grid-row-gap: 30px;
            margin-top: 15px;
        }
        .web_each_video .video_thumbnail_image{
            width: 100%;
            border-radius: 15px;
            border: 1px solid rgba(0,0,0,.2);
            box-shadow: 5px 5px 5px rgba(0,0,0,.2);
            transition: 0.50s all ease;
        }
        .web_each_video .video_thumbnail_image:hover{
            border-radius: 0px;
            box-shadow: 3px 3px 3px rgba(0,0,0,.2);
            border: 1px solid #323438;
        }
        .web_each_video .flex_style{
            align-items : flex-start;
            margin-top: 7px;
        }
        .web_each_video_info{
            /* background: green; */
            
        }
        .other_container{
            position: relative;
            width: 320px;
        }
        .video_other_info{
            margin-left: 5px;
        }
        .video_other_info a {
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            color: black;
        }
        .video_other_info a p{
            font-size: 14px;
            text-decoration: none;
            color: gray;
        }
        .video_other_info p{
            font-size: 12px;
            text-decoration: none;
            color: gray;
        }
        .faculty_profile_pic{
            transition: 0.2s all ease;
        }
        .faculty_profile_pic:hover{
            margin-top: -2px;
        }
        #faculty_name{
            width: 80px;
            transition: 0.2s all ease;
        }
        #faculty_name:hover{
            text-decoration: underline;
        }
        #effect_text{
            font-size: 18px;
            font-weight: 700;
            color: black;
        }
        .effect_content{
            position : absolute;
            margin-top: -203px;
            margin-left: 0px;
            text-align: center;
            align-items: center;
            justify-content: center;
            border-radius: 15px;
            padding-top: 40px;
            background: crimson;
            height: 198px; 
            width: 320px;
            opacity: .9;
            visibility: hidden;
        }
        .effect_content2{
            position : absolute;
            margin-top: -203px;
            margin-left: 0px;
            text-align: center;
            align-items: center;
            justify-content: center;
            border-radius: 15px;
            padding-top: 40px;
            background: crimson;
            height: 198px; 
            width: 320px;
            opacity: .9;
            visibility: hidden;
        }
        .effect_content_container2:hover .effect_content2{
            visibility: visible;
            /* cursor: pointer; */
        }
        .effect_content_container:hover .effect_content{
            visibility: visible;
            /* cursor: pointer; */
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

<!-- ====================================== video content ======================================================== -->

<section class="teachers">
   <h1 class="heading" style = "margin-top: 20px; margin-bottom: 30px;">All Video Content !</h1>
</section>

<div class="web_video_list_container">
    <div class="image_check">
        <img src="{{ asset('img/video_tutorial_banner_image_custome.jpg') }}" alt="">
    </div>
    <div class="under_line"></div>
    <section class="teachers">
        <h1 class="heading" style = "margin-top: 60px">Quality Materials</h1>

        <div class="search-tutor" style = "border: 1px solid rgba(0,0,0,.2); box-shadow: 5px 5px 5px rgba(0,0,0,.2);">
            <input type="text" id="searchBox" name="search_box" placeholder="Search Video Tutorial..." required maxlength="200" oninput="filterVideos()">
            <button class="fas fa-search" name="search_tutor"></button>
        </div>
    </section>

    <h1 id = "noDataMessage" class = "searched_data_not_available_text"></h1>
    

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
    </div>
</div>


<!-- <section class="contact">
    <h2 style = "margin-top : 450px">Anjali Patel</h2>

</section> -->

@include('website_footer')

<script src="{{ asset('js/main_initial_page.js') }}"></script>  

<script>
    
    var noDataMessage = document.getElementById('noDataMessage');
    noDataMessage.style.display = "none";

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
</script>

</body>
</html>