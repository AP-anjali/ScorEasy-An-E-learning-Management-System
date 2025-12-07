@extends('main_admin_dashboard_layout')

@section('title')
<title>Content Management</title>
@endsection

@section('style')
<style>
    #Old_Question_Papers{
        border-left : 6px solid #305d72;
        background: #B7C9E2;
        border-radius: 4px;
    } 

    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
    /* *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "poppins", sans-serif;
    } */
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
        font-weight: 700;
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

    .custome-text-fields{
        display: flex;
        align-items: center;
        border: 1px solid #ccc;
        padding: 2%;
        margin: 0 2%;
        /* width: 46%; */
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

    textarea{
        border: none;
        outline: none;
        background: inherit;
        padding-left: 10px;
        padding-top: 15px;
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

    .text-fields.product_title::after{
        content: 'Product Title';
        background-color: #fff;
        position: relative;
        padding: 0 4%;
        left: -215px;
        color: #696cff;
        top: -28px;
        white-space: nowrap;
    }

    .text-fields.product_description::after{
        content: 'Product Description';
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

    .text-fields.product_quantity::after{
        content: 'Product Quantity';
        background-color: #fff;
        position: relative;
        padding: 0 4%;
        left: -215px;
        color: #696cff;
        top: -28px;
        white-space: nowrap;
    }
    .text-fields.selected_category_name::after{
        content: 'Product Category';
        background-color: #fff;
        position: relative;
        padding: 0 4%;
        left: -215px;
        color: #696cff;
        top: -28px;
        white-space: nowrap;
    }
    .text-fields.product_keywords::after{
        content: 'Product Keywords';
        background-color: #fff;
        position: relative;
        padding: 0 4%;
        left: -215px;
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

    .text-fields.selected_course_name::after{
        content: 'Material Course';
        background-color: #fff;
        position: relative;
        padding: 0 4%;
        left: -240px;
        color: #696cff;
        top: -28px;
        white-space: nowrap;
    }

    .text-fields.material::after{
        content: 'Material';
        background-color: #fff;
        position: relative;
        padding: 0 4%;
        left: -200px;
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
        width: 280px;
        align-items: center;
        margin-left: 14px;
        height: 60px;
        border-radius: 4px;
        border: 1px solid #ccc;
        color: #84848d;
        padding: 2%;
    }

    .file_uploader_heading{
        width: 145px;
        background-color: #FFF;
        position: relative;
        padding: 0 8px;
        left: 175px;
        color: #696cff;
        top: -180px;
        white-space: nowrap;
    }

    .file_uploader_heading_hehe{
        width: 145px;
        background-color: #FFF;
        position: relative;
        padding: 0 8px;
        left: 175px;
        color: #696cff;
        top: -184px;
        white-space: nowrap;
    }

    .file_uploader2{
        display: flex;
        width: 280px;
        align-items: center;
        margin-left: -30px;
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
        left: -260px;
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
    #product_main_image{
        padding-top: 5px;
    }
    #product_other_images{
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
        margin-left: 20%;
    }

    #Update_Paper{
        border: 2px solid #3d5ee1;
        border-radius: 8px;
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
    .file_uploader{
        display: flex;
        width: 300px;
        align-items: center;
        margin-left: 14px;
        height: 60px;
        border-radius: 4px;
        border: 1px solid #ccc;
        color: #84848d;
        padding: 2%;
    }
    .file_uploader_thumb{
        display: flex;
        width: 280px;
        align-items: center;
        margin-left: 14px;
        height: 60px;
        border-radius: 4px;
        border: 1px solid #ccc;
        color: #84848d;
        padding: 2%;
    }
    .file_uploader_heading_thumb{
        width: 190px;
        background-color: #FFF;
        position: relative;
        padding: 0 8px;
        left: 175px;
        color: #696cff;
        top: -70px;
        white-space: nowrap;
    }
    #material{
        margin-top: 5px;
    }
    #Thumbnail_Image{
        margin-top: 5px;
    }

    .file_uploader_heading{
        background-color: #FFF;
        position: relative;
        /* left: -280px; */
        color: #696cff;
        top: -70px;
        width: 70px;
        white-space: nowrap;
    }

    #material{
        cursor: pointer;
    }
    .text-fields.material_title::after{
        content: 'Material Title';
        background-color: #fff;
        position: relative;
        padding: 0 4%;
        left: -200px;
        color: #696cff;
        top: -28px;
        white-space: nowrap;
    }
    .change_color{
        background: #ab65f8;
        transition: 0s all ease;
    }

    .change_color:hover{
        background: #2c3e50;
    }
</style>
@endsection


@section('body')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- <div>Hello From main_admin_dashboard_update_old_question_paper_page</div><br> -->

            @if(Session()->has('message'))

                <div class="msg" id="msg1">
                    {{session()->get('message')}}
                    <button type="button" onclick = "document.getElementById('msg1').style.display = 'none';" id="popup-btn" >X</button>
                </div>

            @endif

            <div class="container">
                <div class="login-link" id = "loginLink">
                    <div class="logo">
                        <i class='bx bxs-objects-vertical-bottom'></i>
                        <span class="text">SCOREASY</span>
                    </div>
                    <p class="side-big-headning" style="text-align: center;">Old Question Papers Updation</p>
                    <p class="primary-bg-text">Update Old Question Papers material<br>Of Existing Courses<br>With All The Required Informations</p>
                    <a href="{{ route('main_admin_dashboard_show_all_old_question_papers_page') }}" class="loginbtn">Exit</a>
                </div>
                <form action="{{ route('updating_old_question_paper', $Question_paper_to_update->id) }}" method = "post" class="signup-form-container" enctype="multipart/form-data">
                    @csrf
                    <p class="big-headning">Update Question Paper Material</p>
                    <div class="progressanjali-bar">
                        <div class="stage">
                            <p class="tool-tip" style="white-space: nowrap;">Course</p>
                            <p class="stageno stageno-1">1</p>
                        </div>
                        <div class="stage">
                            <p class="tool-tip" style="white-space: nowrap;">Material</p>
                            <p class="stageno stageno-2">2</p>
                        </div>
                        <div class="stage">
                            <p class="tool-tip" style="white-space: nowrap;">Title & Description</p>
                            <p class="stageno stageno-3">3</p>
                        </div>
                        <div class="stage">
                            <p class="tool-tip">submission</p>
                            <p class="stageno stageno-4">4</p>
                        </div>
                    </div>
                    <div class="signup-form-content">
                        <div class="stage1-content">
                            <div class="button-container" style="margin-top: 50px; text-align: center; align-items: center; justify-content: center;">
                                <div class="text-fields selected_course_name" style="width: 300px;">
                                    <label for="selected_course_name"><i class='bx bx-envelope' style='color:#6487cb'></i></label>
                                    <select name="selected_course_name" id="my_list2" required style="padding-left: 20px; padding-right: 150px;">
                                        <option value = "{{ $Question_paper_to_update->selected_course_name }}" selected >{{ $Question_paper_to_update->selected_course_name }}</option>

                                        @foreach($all_courses as $each_course)
                                            <option value="{{$each_course->course_name}}">{{$each_course->course_name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="pagination-btns">
                                <input type="button" value="Previous" class="previouspage stagebtn1a">
                                <input type="button" value="Next" class="nextpage stagebtn1b" onclick = "stage1to2()">
                            </div>
                        </div>
                        <div class="stage2-content">
                            <div class="file_uploader" style="margin-top: 20px; text-align: center; align-items: center; justify-content: center; margin-left: 25%;">
                                <label for="material"><i  class='bx bxs-folder-open' style='color:#6487cb'></i></label>
                                <input type="file" name="material" id="material">
                            </div>
                            <div class="file_uploader_heading">Material</div>

                            <div class="file_uploader_thumb" style="margin-top: 20px; text-align: center; align-items: center; justify-content: center; margin-left: 25%;">
                                <label for="Thumbnail_Image"><i  class='bx bxs-folder-open' style='color:#6487cb'></i></label>
                                <input type="file" name="material_Thumbnail_Image" id="Thumbnail_Image">
                            </div>

                            <div class="file_uploader_heading_thumb">Material Thumbnail Image</div>

                            <div class="pagination-btns" style = "margin-top: -20px;">
                                <input type="button" value="Current Material PDF" class="nextpage stagebtn3a change_color" id="Current_Material">
                                <input type="button" value="Current Thumbnail Image" class="nextpage stagebtn3a change_color" id="Current_Material_Thumbnail_image">
                            </div>
                            <div class="pagination-btns" style="margin-top : -20px;">
                                <input type="button" value="Previous" class="previouspage stagebtn2a" onclick = "stage2to1()">
                                <input type="button" value="Next" class="nextpage stagebtn2b" onclick = "stage2to3()">
                            </div>
                        </div>
                        <div class="stage3-content">
                            <div class="button-container">
                                <div class="text-fields material_title" style = "margin-left: 27%;">
                                    <label for="material_title"><i class='bx bxs-doughnut-chart' style='color:#6487cb'></i></label>
                                    <input type="text" name="material_title" id="material_title" value = "{{ $Question_paper_to_update->material_title }}" placeholder="Enter Material Title" required>
                                </div>
                            </div>
                            <div class="button-container" style="margin-top: 20px; text-align: center; align-items: center; justify-content: center;">
                                <div class="custome-text-fields material_description">
                                    <textarea name="material_description" id="material_description" placeholder="Enter Material Description" style="width: 300px !important; height: 120px !important;" required>{{ $Question_paper_to_update->material_description }}</textarea>
                                </div>
                            </div>
                            <div class="file_uploader_heading_hehe">Material Description</div>
                            <div class="pagination-btns" style = "margin-top: -20px;">
                                <input type="button" value="Previous" class="previouspage stagebtn3a" onclick = "stage3to2()">
                                <input type="button" value="Next" class="nextpage stagebtn3b" onclick = "stage3to4()">
                            </div>
                        </div>
                        <div class="stage4-content">
                            <div class="tc-container">
                                <label for="tc" class="tc">
                                    <input type="checkbox" name="tc" id="tc" required>
                                    By submitting Material details, you agree to the <a href="#">terms and conditions</a>
                                </label>
                            </div>
                            <div class="pagination-btns">
                                <input type="button" value="Previous" class="previouspage stagebtn4a" onclick = "stage4to3()">
                                <input type="submit" value="Submit" class="nextpage stagebtn4b">
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
    signUpContent3 = document.querySelector(".stage3-content"),
    signUpContent4 = document.querySelector(".stage4-content");

    signUpContent2.style.display = "none"
    signUpContent3.style.display = "none"
    signUpContent4.style.display = "none"
    previouspage.style.display = "none"

    function validateStage1() {
        var selected_course_name = document.getElementById("my_list2").value;
       
        if (selected_course_name === "") {
            alert("Please fill in all required fields in Stage 1");
            return false;
        }

        return true;
    }

    function validateStage2() {
        return true;
    }

    function validateStage3() {
        var material_title = document.getElementById("material_title").value;
        var material_description = document.getElementById("material_description").value;

        if (material_title === "" || material_description === "") {
            alert("Please fill in all required fields in Stage 3");
            return false;
        }

        return true;
    }



    function stage1to2(){
        if (validateStage1()) {
            signUpContent1.style.display = "none";
            signUpContent3.style.display = "none";
            signUpContent2.style.display = "block";
            signUpContent4.style.display = "none";
            document.querySelector(".stageno-1").innerText = "✔";
            document.querySelector(".stageno-1").style.backgroundColor = "#52ec61";
        }
    }

    function stage2to1(){
        signUpContent1.style.display = "block"
        signUpContent3.style.display = "none"
        signUpContent2.style.display = "none"
        signUpContent4.style.display = "none"
    }

    function stage2to3(){
        if (validateStage2()) {
            signUpContent1.style.display = "none"
            signUpContent3.style.display = "block"
            signUpContent2.style.display = "none"
            signUpContent4.style.display = "none"
            document.querySelector(".stageno-2").innerText = "✔";
            document.querySelector(".stageno-2").style.backgroundColor = "#52ec61";
        }
    }

    function stage3to2(){
        signUpContent1.style.display = "none"
        signUpContent3.style.display = "none"
        signUpContent2.style.display = "block"
        signUpContent4.style.display = "none"
    }

    function stage3to4(){
        if (validateStage3()) {
            signUpContent1.style.display = "none"
            signUpContent3.style.display = "none"
            signUpContent2.style.display = "none"
            signUpContent4.style.display = "block"
            document.querySelector(".stageno-3").innerText = "✔";
            document.querySelector(".stageno-3").style.backgroundColor = "#52ec61";
        }
    }

    function stage4to3(){
        signUpContent1.style.display = "none"
        signUpContent3.style.display = "block"
        signUpContent2.style.display = "none"
        signUpContent4.style.display = "none"
    }

    document.getElementById('Current_Material').addEventListener('click', function() {
        var id_for_updatepage_url = {{ $Question_paper_to_update->id }}; 
        var question_paper_id = {{ $Question_paper_to_update->id }}; 
        var newUrl = '/main_admin_dashboard_update_old_question_paper_page/updating_old_question_paper/' + id_for_updatepage_url + '/show_current_old_question_paper_pdf_to_admin_for_update_old_question_paper_page/' + question_paper_id;
        window.open(newUrl, '_blank');
    });

    document.getElementById('Current_Material_Thumbnail_image').addEventListener('click', function() {
        var id_for_updatepage_url = {{ $Question_paper_to_update->id }}; 
        var question_paper_id = {{ $Question_paper_to_update->id }}; 
        var newUrl = '/main_admin_dashboard_update_old_question_paper_page/updating_old_question_paper/' + id_for_updatepage_url + '/show_current_old_question_paper_thumbnail_image_to_admin_for_update_old_question_paper_page/' + question_paper_id;
        window.open(newUrl, '_blank');
    });

    document.addEventListener('DOMContentLoaded', function() {
        var textFields = document.querySelectorAll('.text-fields input');
        var custometextFields = document.querySelectorAll('.custome-text-fields textarea');

        textFields.forEach(function(input) {
            input.addEventListener('focus', function() {
                this.parentElement.style.borderColor = '#696cff';
            });

            input.addEventListener('blur', function() {
                this.parentElement.style.borderColor = '';
            });
        });

        custometextFields.forEach(function(input) {
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