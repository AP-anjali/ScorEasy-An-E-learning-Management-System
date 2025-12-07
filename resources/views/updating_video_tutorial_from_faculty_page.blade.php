@extends('main_faculty_dashboard_layout')

@section('title')
<title>Tutorials Management</title>
@endsection

@section('style')
<style>
    #Tutorials{
        border-left : 6px solid #305d72;
        background: #B7C9E2;
        border-radius: 4px;
    } 
    #update_tutorials{
        border: 2px solid #3d5ee1;
        border-radius: 8px;
    }
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "poppins", sans-serif;
    }
    body{
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        background-color: #f5f5f9;
    }
    .container{
        width: 80%;
        margin: 6% auto;
        /* margin: 9px; */
        position: relative;
        bottom: 40px;
        display: flex;
        height: 623px;
        /* height: 565px; */
        box-shadow: 0 12px 18px rgba(54, 176, 138, 0.005);
        border-radius: 6px;
        background: #FFF;
    }
    .login-link{
        background-color: #696cff;
        /* background-image: url('bg-shapes.svg'); */
        background-position: bottom left;
        background-repeat: no-repeat;
        width: 35%;
        /* width: 400px; */
        padding: 3%;
    }
    .signup-form-container{
        width: 70%;
        max-width: 700px;
        padding: 3% 0;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .logo{
        font-weight: 600;
        color: #FFF;
    }
    .side-big-headning{
        font-weight: 800;
        color: #FFF;
        font-size: 1.6rem;
        margin: 46% 0 5%;
    }
    .primary-bg-text{
        color: #eff0ff;
        font-weight: 500;
        text-align: center;
    }
    a.loginbtn{
        text-decoration: none;
        color: #FFF;
        width: 70%;
        font-weight: 500;
        display: inline-block;
        margin: 7% 15%;
        text-align: center;
        border: 2px solid #eff0ff;
        border-radius: 24px;
        padding: 3% 0;
    }
    a.loginbtn:hover{
        color: #696cff;
        background-color: #FFF;
    }
    .big-headning{
        font-weight: 900;
        font-size: 2rem;
        color: #696cff;
    }
    .social-media-platform{
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .social-media-platform a{
        color: #1a1d86;
        text-decoration: none;
        border-radius: 50%;
        display: inline-flex;
        border: 1px solid #e0e3e2;
        margin: 12%;
        padding: 13%;
    }
    .progressanjali-bar{
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 4% 0;
        width: 90%;
    }
    .progressanjali-bar .stage{
        width: 30%;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }
    .progressanjali-bar .tool-tip{
        color: #1a1d86;
        font-weight: 600;
    }
    .progressanjali-bar .stageno{
        margin: 6% 0;
        padding: 2% 7%;
        border-radius: 50%;
        background-color: #f5f5f9;
        color: #000;
    }

    .button-container{
        display: flex;
        align-items: center;
        margin: 4% 0;
    }

    .text-fields{
        display: flex;
        align-items: center;
        border: 1px solid #ccc;
        padding: 2%;
        margin: 0 2%;
        width: 46%;
        border-radius: 4px;
        color: #84848d;
    }
    input{
        border: none;
        outline: none;
        background: inherit;
        padding-left: 10px;
        color: #84848d;
        /* width: 400%; */
        margin-left: 4%;
        font-size: 1rem;
    }
    .signup-form-content{
        width: 100%;
        padding: 0 3%;
    }
    .text-fields.product_name::after{
        content: 'Product Name';
        background-color: #fff;
        position: relative;
        padding: 0 4%;
        left: -215px;
        color: #696cff;
        top: -28px;
        white-space: nowrap;
    }

    .text-fields.product_brand::after{
        content: 'Product Brand';
        background-color: #fff;
        position: relative;
        padding: 0 4%;
        left: -215px;
        color: #696cff;
        top: -28px;
        white-space: nowrap;
    }

    .text-fields.video_tutorial_title::after{
        content: 'Video Title';
        background-color: #fff;
        position: relative;
        padding: 0 4%;
        left: -215px;
        color: #696cff;
        top: -28px;
        white-space: nowrap;
    }

    .text-fields.video_tutorial_description::after{
        content: 'Video Description';
        background-color: #fff;
        position: relative;
        padding: 0 4%;
        left: -215px;
        color: #696cff;
        top: -28px;
        white-space: nowrap;
    }

    .text-fields.product_price::after{
        content: 'Product Price';
        background-color: #fff;
        position: relative;
        padding: 0 4%;
        left: -215px;
        color: #696cff;
        top: -28px;
        white-space: nowrap;
    }

    .text-fields.discount_price::after{
        content: 'Product Discount Price';
        background-color: #fff;
        position: relative;
        padding: 0 4%;
        left: -215px;
        color: #696cff;
        top: -28px;
        white-space: nowrap;
    }

    .text-fields.video_tutorial_keywords_or_tags::after{
        content: 'Keywords & Tags';
        background-color: #fff;
        position: relative;
        padding: 0 4%;
        left: -215px;
        color: #696cff;
        top: -28px;
        white-space: nowrap;
    }
    .text-fields.video_tutorial_selected_Language::after{
        content: 'Video Language';
        background-color: #fff;
        position: relative;
        padding: 0 4%;
        left: -180px;
        color: #696cff;
        top: -28px;
        white-space: nowrap;
    }
    .text-fields.video_tutorial_selected_course_name::after{
        content: 'Course of Video';
        background-color: #fff;
        position: relative;
        padding: 0 4%;
        left: -190px;
        color: #696cff;
        top: -28px;
        white-space: nowrap;
    }


    .text-fields.video_tutorial_selected_subject_name::after{
        content: 'Subject of Video';
        background-color: #fff;
        position: relative;
        padding: 0 4%;
        left: -265px;
        color: #696cff;
        top: -28px;
        white-space: nowrap;
    }

    .text-fields.product_color::after{
        content: 'Product Color';
        background-color: #fff;
        position: relative;
        padding: 0 4%;
        left: -215px;
        color: #696cff;
        top: -28px;
        white-space: nowrap;
    }

    .text-fields.product_size::after{
        content: 'Product Size';
        background-color: #fff;
        position: relative;
        padding: 0 4%;
        left: -215px;
        color: #696cff;
        top: -28px;
        white-space: nowrap;
    }
    .text-fields.product_weight::after{
        content: 'Product Weight';
        background-color: #fff;
        position: relative;
        padding: 0 4%;
        left: -215px;
        color: #696cff;
        top: -28px;
        white-space: nowrap;
    }
 
    #my_list{
        border: none;
        outline: none;
        background: inherit;
        color: #84848d;
        margin-top: 4px;
        font-size: 1rem;
    }
    .text-fields.business_type select {
        padding-left: 20px; 
    }
    #my_list2{
        border: none;
        outline: none;
        padding-left: 10px;
        background: inherit;
        color: #84848d;
        margin-top: 4px;
        font-size: 1rem;
    }

    #my_list5{
        border: none;
        outline: none;
        background: inherit;
        padding-left: 10px;
        color: #84848d;
        margin-top: 4px;
        font-size: 1rem;
    }
    #my_list6{
        border: none;
        outline: none;
        background: inherit;
        padding-left: 10px;
        color: #84848d;
        margin-top: 4px;
        font-size: 1rem;
    }
    .text-fields.business_strength select {
        padding-left: 20px; 
    }
    #my_list3{
        border: none;
        outline: none;
        background: inherit;
        color: #84848d;
        margin-top: 4px;
        font-size: 1rem;
    }
    .text-fields.product_category select {
        padding-left: 20px; 
    }
    #my_list4{
        border: none;
        outline: none;
        background: inherit;
        color: #84848d;
        margin-top: 4px;
        font-size: 1rem;
    }
    .text-fields.account_type select {
        padding-left: 5px; 
    }
    .file_uploader{
        display: flex;
        width: 295px;
        align-items: center;
        margin-left: 14px;
        height: 60px;
        border-radius: 4px;
        border: 1px solid #ccc;
        color: #84848d;
        padding: 2%;
    }

    .file_uploader_heading{
        background-color: #FFF;
        position: relative;
        padding: 0 8px;
        left: -275px;
        color: #696cff;
        top: -28px;
        white-space: nowrap;
    }

    .file_uploader2{
        display: flex;
        width: 295px;
        align-items: center;
        margin-left: -66px;
        height: 60px;
        border-radius: 4px;
        border: 1px solid #ccc;
        color: #84848d;
        padding: 2%;
    }

    .file_uploader_heading2{
        background-color: #FFF;
        position: relative;
        padding: 0 8px;
        left: -275px;
        color: #696cff;
        top: -28px;
        white-space: nowrap;
    }

    #proof_of_bank_account_ownership{
        cursor: pointer;
    }
    .pagination-btns{
        display: flex;
        justify-content: center;
        margin: 3% 0;
        padding: 0 4%;
    }
    .nextpage, .previouspage{
        background-color: #8789ff;
        color: #FFF;
        width: 45%;
        cursor: pointer;
        padding: 2%;
        margin: 20px;
        font-weight: 500;
        font-size: 1rem;
        border-radius: 4px;
        border: none;
        outline: none;
    }
    .nextpage:hover, .previouspage:hover{
        background-color: #696cff;
    }
    .tc-container input{
        width: 10%;
        margin-left: 4%;
        accent-color: #696cff;
    }
    .tc a{
        text-decoration: none;
        color: #696cff;
    }
    .tc a:hover{
        color: #1a1d86;
    }
    label.tc{
        margin-left: 4%;
        white-space: nowrap;
    }
    .khaskao{
        margin-top: 5px;
        margin-bottom: 10px;
        margin-left: 170px;
        width: 290px;
    }
    #video_tutorial_url{
        padding-top: 5px;
    }
    #video_tutorial_Thumbnail_Image{
        padding-top: 5px;
    }
    .msg{
        width: 50%;
        height: 50px;
        color: green;
        font-size: 20px;
        border-radius: 6px;
        padding: 8px 0 0 25px;
        background: white;
        border: 1px solid rgba(0,0,0,.2);
        box-shadow: 5px 5px 5px rgba(0,0,0,.2);
        margin-top: 20px;
        margin-left: 20px;
        align-items: center;
        justify-content: center;
    }

    #popup-btn{
        height: 80%;
        margin-bottom: 8px;
        width: 30px;
        padding-bottom: 4px;
        border: 1px solid rgba(0,0,0,.2);
        border-radius: 6px;
        background: rgba(0,0,0,.2);
        margin-left: 33%;
    }

    .change_color{
        background: #ab65f8;
        transition: 0s all ease;
    }

    .change_color:hover{
        background: #2c3e50;
    }

    .page-wrapper{
        /* overflow-x: auto; */
        overflow: auto;
    }

    ::-webkit-scrollbar {
        width: 9px;
        height: 10px;
    }

    ::-webkit-scrollbar-thumb {
        background-color: #929292;
        border-radius: 10px;
    }

    ::-webkit-scrollbar-track {
        background: #B7C9E2;
    }

    ::-webkit-scrollbar-thumb:hover {
        background-color: #454545;
    }
</style>
@endsection


@section('body')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- <div>Hello From form_for_video_type_tutorial</div><br> -->

            @if(Session()->has('update_video_tutorial_msg'))

                <div class="msg" id="msg1">
                    {{session()->get('update_video_tutorial_msg')}}
                    <button type="button" onclick = "document.getElementById('msg1').style.display = 'none';" id="popup-btn" >X</button>
                </div>

            @endif

            <div class="container">
                <div class="login-link" id = "loginLink">
                    <div class="logo">
                        <i class='bx bxs-objects-vertical-bottom'></i>
                        <span class="text">SCOREASY</span>
                    </div>
                    <p class="side-big-headning" style="text-align: center; white-space: nowrap;">Tutorials Updation</p>
                    <p class="primary-bg-text">Update Your Video Tutorials<br>With All The Required Informations</p>
                    <a href="{{ route('view_of_faculty_for_video_type_tutorial') }}" class="loginbtn">Back</a>
                </div>
                <form action="{{ route('updating_video_tutorial_from_faculty_page_form_submission', $video_tutorial_to_update_from_faculty->id) }}" method = "post" class="signup-form-container" enctype="multipart/form-data">
                    @csrf
                    <p class="big-headning">Edit Your Video Tutorial</p>
                    <div class="progressanjali-bar">
                        <div class="stage">
                            <p class="tool-tip">Basic Information</p>
                            <p class="stageno stageno-1">1</p>
                        </div>
                        <div class="stage">
                            <p class="tool-tip">Video Attributes</p>
                            <p class="stageno stageno-2">2</p>
                        </div>
                        <div class="stage">
                            <p class="tool-tip">submission</p>
                            <p class="stageno stageno-3">3</p>
                        </div>
                    </div>
                    <div class="signup-form-content">
                        <div class="stage1-content">
                            <div class="button-container">
                                <div class="file_uploader">
                                    <label for="video_tutorial_url"><i  class='bx bxs-folder-open' style='color:#6487cb'></i></label>
                                    <input type="file" name="video_tutorial_url" id="video_tutorial_url">
                                </div>
                                <div class="file_uploader_heading">Select Video</div>

                                <div class="file_uploader2">
                                    <label for="video_tutorial_Thumbnail_Image"><i  class='bx bxs-folder-open' style='color:#6487cb'></i></label>
                                    <input type="file" name="video_tutorial_Thumbnail_Image" id="video_tutorial_Thumbnail_Image">
                                </div>
                                <div class="file_uploader_heading2">Select Thumbnail Image</div>

                            </div>
                            <div class="pagination-btns" style = "margin-top: -20px;">
                                <input type="button" value="Current Video" class="nextpage stagebtn3a change_color" id="Current_Video">
                                <input type="button" value="Current Thumbnail Image" class="nextpage stagebtn3b change_color" id="Current_Thumbnail_Images">
                            </div>
                            <div class="button-container" style="margin-top : -10px;">
                                <div class="text-fields video_tutorial_title">
                                    <label for="video_tutorial_title"><i class='bx bx-phone-call' style='color:#6487cb'></i></label>
                                    <input type="text" name="video_tutorial_title" id="video_tutorial_title" value = "{{ $video_tutorial_to_update_from_faculty->video_tutorial_title }}" required>
                                </div>
                                <div class="text-fields video_tutorial_description">
                                    <label for="video_tutorial_description"><i class='bx bxl-periscope' style='color:#6487cb' ></i></label>
                                    <input type="text" name="video_tutorial_description" id="video_tutorial_description" value = "{{ $video_tutorial_to_update_from_faculty->video_tutorial_description }}" required>
                                </div>
                            </div>
                            <div class="pagination-btns">
                                <input type="button" value="Previous" class="previouspage stagebtn1a">
                                <input type="button" value="Next" class="nextpage stagebtn1b" onclick = "stage1to2()">
                            </div>
                        </div>
                        <div class="stage2-content">
                            <div class="button-container">
                                <div class="text-fields video_tutorial_selected_Language">
                                    <label for="video_tutorial_selected_Language"><i class='bx bx-envelope' style='color:#6487cb'></i></label>
                                    <select name="video_tutorial_selected_Language" id="my_list2" required>
                                        <option value = "{{ $video_tutorial_to_update_from_faculty->video_tutorial_selected_Language }}" selected>{{ $video_tutorial_to_update_from_faculty->video_tutorial_selected_Language }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
                                        @foreach($all_languages as $each_language)
                                            <option value="{{$each_language->language_name}}">{{$each_language->language_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="text-fields video_tutorial_keywords_or_tags">
                                    <label for="video_tutorial_keywords_or_tags"><i class='bx bx-user-circle iconanjali' style='color:#6487cb'></i></label>
                                    <input type="text" name="video_tutorial_keywords_or_tags" min="0" id="video_tutorial_keywords_or_tags" value = "{{ $video_tutorial_to_update_from_faculty->video_tutorial_keywords_or_tags }}" required>
                                </div>
                            </div>
                            <div class="button-container">
                                <div class="text-fields video_tutorial_selected_course_name">
                                    <label for="video_tutorial_selected_course_name"><i class='bx bx-envelope' style='color:#6487cb'></i></label>
                                    <select name="video_tutorial_selected_course_name" id="my_list5" required>
                                        <option value = "{{ $video_tutorial_to_update_from_faculty->video_tutorial_selected_course_name }}" selected>{{ $video_tutorial_to_update_from_faculty->video_tutorial_selected_course_name }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
                                        @foreach($all_courses as $each_course)
                                            <option value="{{$each_course->course_name}}">{{$each_course->course_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="text-fields video_tutorial_selected_subject_name">
                                    <label for="video_tutorial_selected_subject_name"><i class='bx bx-envelope' style='color:#6487cb'></i></label>
                                    <select name="video_tutorial_selected_subject_name" id="my_list6" required>
                                        <option value = "{{ $video_tutorial_to_update_from_faculty->video_tutorial_selected_subject_name }}" selected>{{ $video_tutorial_to_update_from_faculty->video_tutorial_selected_subject_name }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
                                        @foreach($all_subjects as $each_subject)
                                            <option value="{{$each_subject->subject_name}}">{{$each_subject->subject_name}}</option>
                                        @endforeach
                                    </select>
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
                                <input type="button" value="Previous" class="previouspage stagebtn3a" onclick = "stage3to2()">
                                <input type="submit" value="Submit" class="nextpage stagebtn3b">
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection

@section('script')
<script>
    let signUpContent = document.querySelector(".signup-form-container"),
    stagebtn1b = document.querySelector(".stagebtn1b"),
    stagebtn2a = document.querySelector(".stagebtn2a"),
    stagebtn2b = document.querySelector(".stagebtn2b"),
    stagebtn3a = document.querySelector(".stagebtn3a"),
    stagebtn3b = document.querySelector(".stagebtn3b"),
    previouspage = document.querySelector(".previouspage"),
    signUpContent1 = document.querySelector(".stage1-content"),
    signUpContent2 = document.querySelector(".stage2-content"),
    signUpContent3 = document.querySelector(".stage3-content");

    signUpContent2.style.display = "none"
    signUpContent3.style.display = "none"
    previouspage.style.display = "none"


    function validateStage1() {

        var video_tutorial_url = document.getElementById("video_tutorial_url").value;
        var video_tutorial_title = document.getElementById("video_tutorial_title").value;
        var video_tutorial_description = document.getElementById("video_tutorial_description").value;

        if ((!video_tutorial_url.trim() || !video_tutorial_url === "{{ $video_tutorial_to_update_from_faculty->video_tutorial_url }}") &&
            (!video_tutorial_title.trim() || !video_tutorial_title === "{{ $video_tutorial_to_update_from_faculty->video_tutorial_title }}") &&
            (!video_tutorial_description.trim() || !video_tutorial_description === "{{ $video_tutorial_to_update_from_faculty->video_tutorial_description }}")) {
            alert("Please fill in all required fields in Stage 1");
            return false;
        }

        return true;
    }

    function validateStage2() {

        var video_tutorial_selected_Language = document.getElementById("my_list2").value;
        var video_tutorial_keywords_or_tags = document.getElementById("video_tutorial_keywords_or_tags").value;
        var video_tutorial_selected_course_name = document.getElementById("my_list5").value;
        var video_tutorial_selected_subject_name = document.getElementById("my_list6").value;

        if ((!video_tutorial_selected_Language.trim() || !video_tutorial_selected_Language === "{{ $video_tutorial_to_update_from_faculty->video_tutorial_selected_Language }}") &&
            (!video_tutorial_keywords_or_tags.trim() || !video_tutorial_keywords_or_tags === "{{ $video_tutorial_to_update_from_faculty->video_tutorial_keywords_or_tags }}") &&
            (!video_tutorial_selected_course_name.trim() || !video_tutorial_selected_course_name === "{{ $video_tutorial_to_update_from_faculty->video_tutorial_selected_course_name }}") &&
            (!video_tutorial_selected_subject_name.trim() || !video_tutorial_selected_subject_name === "{{ $video_tutorial_to_update_from_faculty->video_tutorial_selected_subject_name }}")) {
            alert("Please fill in all required fields in Stage 2");
            return false;
        }

        return true;
    }

    function stage1to2(){
        if (validateStage1()) {
            signUpContent1.style.display = "none";
            signUpContent3.style.display = "none";
            signUpContent2.style.display = "block";
            document.querySelector(".stageno-1").innerText = "✔";
            document.querySelector(".stageno-1").style.backgroundColor = "#52ec61";
        }
    }

    function stage2to1(){
        signUpContent1.style.display = "block"
        signUpContent3.style.display = "none"
        signUpContent2.style.display = "none"
    }

    function stage2to3(){
        if (validateStage2()) {
            signUpContent1.style.display = "none"
            signUpContent3.style.display = "block"
            signUpContent2.style.display = "none"
            document.querySelector(".stageno-2").innerText = "✔";
            document.querySelector(".stageno-2").style.backgroundColor = "#52ec61";
        }
    }

    function stage3to2(){
        signUpContent1.style.display = "none"
        signUpContent3.style.display = "none"
        signUpContent2.style.display = "block"
    }

    document.getElementById('Current_Video').addEventListener('click', function() {
        var id_for_updatepage_url = {{ $video_tutorial_to_update_from_faculty->id }}; 
        var video_tutorial_id = {{ $video_tutorial_to_update_from_faculty->id }}; 
        window.location.href = '/main_faculty_dashboard_update_tutorial_page/updating_video_tutorial_from_faculty_page/' + id_for_updatepage_url + '/show_current_video_to_faculty_for_update_video_tutorial_page/' + video_tutorial_id;
    });

    
    document.getElementById('Current_Thumbnail_Images').addEventListener('click', function() {
        var id_for_updatepage_url = {{ $video_tutorial_to_update_from_faculty->id }}; 
        var video_tutorial_id = {{ $video_tutorial_to_update_from_faculty->id }}; 
        window.location.href = '/main_faculty_dashboard_update_tutorial_page/updating_video_tutorial_from_faculty_page/' + id_for_updatepage_url + '/show_Current_Thumbnail_Images_to_faculty_for_update_video_tutorial_page/' + video_tutorial_id;
    });

    document.addEventListener('DOMContentLoaded', function() {
        var textFields = document.querySelectorAll('.text-fields input');

        textFields.forEach(function(input) {
            input.addEventListener('focus', function() {
                this.parentElement.style.borderColor = '#696cff';
            });

            input.addEventListener('blur', function() {
                this.parentElement.style.borderColor = ''; 
            });
        });
    });
</script>
@endsection