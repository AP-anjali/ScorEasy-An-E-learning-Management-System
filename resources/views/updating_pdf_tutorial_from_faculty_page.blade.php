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

    .text-fields.PDF_tutorial_title::after{
        content: 'PDF Title';
        background-color: #fff;
        position: relative;
        padding: 0 4%;
        left: -215px;
        color: #696cff;
        top: -28px;
        white-space: nowrap;
    }

    .text-fields.PDF_tutorial_description::after{
        content: 'PDF Description';
        background-color: #fff;
        position: relative;
        padding: 0 4%;
        left: -215px;
        color: #696cff;
        top: -28px;
        white-space: nowrap;
    }

    .text-fields.PDF_tutorial_keywords_or_tags::after{
        content: 'Keywords & Tags';
        background-color: #fff;
        position: relative;
        padding: 0 4%;
        left: -210px;
        color: #696cff;
        top: -28px;
        white-space: nowrap;
    }
    .text-fields.PDF_tutorial_selected_Language::after{
        content: 'PDF Language';
        background-color: #fff;
        position: relative;
        padding: 0 4%;
        left: -200px;
        color: #696cff;
        top: -28px;
        white-space: nowrap;
    }
    .text-fields.PDF_tutorial_selected_course_name::after{
        content: 'Course of PDF';
        background-color: #fff;
        position: relative;
        padding: 0 4%;
        left: -194px;
        color: #696cff;
        top: -28px;
        white-space: nowrap;
    }

    .text-fields.PDF_tutorial_selected_subject_name::after{
        content: 'Subject of PDF';
        background-color: #fff;
        position: relative;
        padding: 0 4%;
        left: -255px;
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
        background: inherit;
        padding-left: 10px;
        color: #84848d;
        margin-top: 4px;
        font-size: 1rem;
    }

    #my_list5{
        border: none;
        outline: none;
        padding-left: 10px;
        background: inherit;
        color: #84848d;
        margin-top: 4px;
        font-size: 1rem;
    }
    #my_list6{
        border: none;
        outline: none;
        padding-left: 10px;
        background: inherit;
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
    #PDF_tutorial_path{
        padding-top: 5px;
    }
    #PDF_tutorial_Thumbnail_Image{
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

    #update_tutorials{
        border: 2px solid #3d5ee1;
        border-radius: 8px;
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
            <!-- <div>Hello From updating_pdf_tutorial_from_faculty_page</div><br> -->

            @if(Session()->has('update_pdf_tutorial_msg'))

                <div class="msg" id="msg1">
                    {{session()->get('update_pdf_tutorial_msg')}}
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
                    <p class="primary-bg-text">Update Your PDF Tutorials<br>With All The Required Informations</p>
                    <a href="{{ route('view_of_faculty_for_pdf_type_tutorial') }}" class="loginbtn">Back</a>
                </div>
                <form action="{{ route('updating_pdf_tutorial_from_faculty_page_form_submission', $pdf_tutorial_to_update_from_faculty->id) }}" method = "post" class="signup-form-container" enctype="multipart/form-data">
                    @csrf
                    <p class="big-headning">Edit Your PDF Tutorial</p>
                    <div class="progressanjali-bar">
                        <div class="stage">
                            <p class="tool-tip">Basic Information</p>
                            <p class="stageno stageno-1">1</p>
                        </div>
                        <div class="stage">
                            <p class="tool-tip">PDF Attributes</p>
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
                                    <label for="PDF_tutorial_path"><i  class='bx bxs-folder-open' style='color:#6487cb'></i></label>
                                    <input type="file" name="PDF_tutorial_path" id="PDF_tutorial_path">
                                </div>
                                <div class="file_uploader_heading">Select PDF</div>

                                <div class="file_uploader2">
                                    <label for="PDF_tutorial_Thumbnail_Image"><i  class='bx bxs-folder-open' style='color:#6487cb'></i></label>
                                    <input type="file" name="PDF_tutorial_Thumbnail_Image" id="PDF_tutorial_Thumbnail_Image">
                                </div>
                                <div class="file_uploader_heading2">Select Thumbnail Image</div>

                            </div>
                            <div class="pagination-btns" style = "margin-top: -20px;">
                                <input type="button" value="Current PDF" class="nextpage stagebtn3a change_color" id="Current_PDF">
                                <input type="button" value="Current Thumbnail Image" class="nextpage stagebtn3b change_color" id="Current_Thumbnail_Image">
                            </div>
                            <div class="button-container" style="margin-top : -10px;">
                                <div class="text-fields PDF_tutorial_title">
                                    <label for="PDF_tutorial_title"><i class='bx bx-phone-call' style='color:#6487cb'></i></label>
                                    <input type="text" name="PDF_tutorial_title" id="PDF_tutorial_title" value = "{{ $pdf_tutorial_to_update_from_faculty->PDF_tutorial_title }}" required>
                                </div>
                                <div class="text-fields PDF_tutorial_description">
                                    <label for="PDF_tutorial_description"><i class='bx bxl-periscope' style='color:#6487cb' ></i></label>
                                    <input type="text" name="PDF_tutorial_description" id="PDF_tutorial_description" value = "{{ $pdf_tutorial_to_update_from_faculty->PDF_tutorial_description }}" required>
                                </div>
                            </div>
                            <div class="pagination-btns">
                                <input type="button" value="Previous" class="previouspage stagebtn1a">
                                <input type="button" value="Next" class="nextpage stagebtn1b" onclick = "stage1to2()">
                            </div>
                        </div>
                        <div class="stage2-content">
                            <div class="button-container">
                                <div class="text-fields PDF_tutorial_selected_Language">
                                    <label for="PDF_tutorial_selected_Language"><i class='bx bx-envelope' style='color:#6487cb'></i></label>
                                    <select name="PDF_tutorial_selected_Language" id="my_list2" required>
                                        <option value = "{{ $pdf_tutorial_to_update_from_faculty->PDF_tutorial_selected_Language }}" selected>{{ $pdf_tutorial_to_update_from_faculty->PDF_tutorial_selected_Language }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
                                        @foreach($all_languages as $each_language)
                                            <option value="{{$each_language->language_name}}">{{$each_language->language_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="text-fields PDF_tutorial_keywords_or_tags">
                                    <label for="PDF_tutorial_keywords_or_tags"><i class='bx bx-user-circle iconanjali' style='color:#6487cb'></i></label>
                                    <input type="text" name="PDF_tutorial_keywords_or_tags" min="0" id="PDF_tutorial_keywords_or_tags" value = "{{ $pdf_tutorial_to_update_from_faculty->PDF_tutorial_keywords_or_tags }}" required>
                                </div>
                            </div>
                            <div class="button-container">
                                <div class="text-fields PDF_tutorial_selected_course_name">
                                    <label for="PDF_tutorial_selected_course_name"><i class='bx bx-envelope' style='color:#6487cb'></i></label>
                                    <select name="PDF_tutorial_selected_course_name" id="my_list5" required>
                                        <option value = "{{ $pdf_tutorial_to_update_from_faculty->PDF_tutorial_selected_course_name }}" selected>{{ $pdf_tutorial_to_update_from_faculty->PDF_tutorial_selected_course_name }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
                                        @foreach($all_courses as $each_course)
                                            <option value="{{$each_course->course_name}}">{{$each_course->course_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="text-fields PDF_tutorial_selected_subject_name">
                                    <label for="PDF_tutorial_selected_subject_name"><i class='bx bx-envelope' style='color:#6487cb'></i></label>
                                    <select name="PDF_tutorial_selected_subject_name" id="my_list6" required>
                                        <option value = "{{ $pdf_tutorial_to_update_from_faculty->PDF_tutorial_selected_subject_name }}" selected>{{ $pdf_tutorial_to_update_from_faculty->PDF_tutorial_selected_subject_name }}&nbsp;&nbsp;&nbsp;&nbsp;</option>
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

        var PDF_tutorial_path = document.getElementById("PDF_tutorial_path").value;
        var PDF_tutorial_title = document.getElementById("PDF_tutorial_title").value;
        var PDF_tutorial_description = document.getElementById("PDF_tutorial_description").value;

        if ((!PDF_tutorial_path.trim() || !PDF_tutorial_path === "{{ $pdf_tutorial_to_update_from_faculty->PDF_tutorial_path }}") &&
            (!PDF_tutorial_title.trim() || !PDF_tutorial_title === "{{ $pdf_tutorial_to_update_from_faculty->PDF_tutorial_title }}") &&
            (!PDF_tutorial_description.trim() || !PDF_tutorial_description === "{{ $pdf_tutorial_to_update_from_faculty->PDF_tutorial_description }}")) {
            alert("Please fill in all required fields in Stage 1");
            return false;
        }

        return true;
    }

    function validateStage2() {

        var PDF_tutorial_selected_Language = document.getElementById("my_list2").value;
        var PDF_tutorial_keywords_or_tags = document.getElementById("PDF_tutorial_keywords_or_tags").value;
        var PDF_tutorial_selected_course_name = document.getElementById("my_list5").value;
        var PDF_tutorial_selected_subject_name = document.getElementById("my_list6").value;

        if ((!PDF_tutorial_selected_Language.trim() || !PDF_tutorial_selected_Language === "{{ $pdf_tutorial_to_update_from_faculty->PDF_tutorial_selected_Language }}") &&
            (!PDF_tutorial_keywords_or_tags.trim() || !PDF_tutorial_keywords_or_tags === "{{ $pdf_tutorial_to_update_from_faculty->PDF_tutorial_keywords_or_tags }}") &&
            (!PDF_tutorial_selected_course_name.trim() || !PDF_tutorial_selected_course_name === "{{ $pdf_tutorial_to_update_from_faculty->PDF_tutorial_selected_course_name }}") &&
            (!PDF_tutorial_selected_subject_name.trim() || !PDF_tutorial_selected_subject_name === "{{ $pdf_tutorial_to_update_from_faculty->PDF_tutorial_selected_subject_name }}")) {
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

    document.getElementById('Current_PDF').addEventListener('click', function() {
        var id_for_updatepage_url = {{ $pdf_tutorial_to_update_from_faculty->id }}; 
        var pdf_tutorial_id = {{ $pdf_tutorial_to_update_from_faculty->id }}; 
        window.location.href = '/main_faculty_dashboard_update_tutorial_page/updating_pdf_tutorial_from_faculty_page/' + id_for_updatepage_url + '/show_current_pdf_to_faculty_for_update_pdf_tutorial_page/' + pdf_tutorial_id;
    });

    document.getElementById('Current_Thumbnail_Image').addEventListener('click', function() {
        var id_for_updatepage_url = {{ $pdf_tutorial_to_update_from_faculty->id }}; 
        var pdf_tutorial_id = {{ $pdf_tutorial_to_update_from_faculty->id }}; 
        window.location.href = '/main_faculty_dashboard_update_tutorial_page/updating_pdf_tutorial_from_faculty_page/' + id_for_updatepage_url + '/show_current_thumbnail_image_to_faculty_for_update_pdf_tutorial_page/' + pdf_tutorial_id;
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