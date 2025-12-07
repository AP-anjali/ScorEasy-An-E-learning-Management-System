@extends('main_admin_dashboard_layout')

@section('title')
<title>System Report Management</title>
@endsection

@section('style')
<style>
    #Users{
        border-left : 6px solid #305d72;
        background: #B7C9E2;
        border-radius: 4px;
    } 

    #all_faculty{
        border: 2px solid #3d5ee1;
        border-radius: 8px;
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
        height: 680px;
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
    .progress-baranjali{
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 4% 0;
        width: 90%;
    }
    .progress-baranjali .stage{
        width: 30%;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }
    .progress-baranjali .tool-tip{
        color: #1a1d86;
        font-weight: 600;
    }
    .stageno{
        margin: 6% 0;
        padding: 2% 7%;
        border-radius: 50%;
        background-color: #f5f5f9;
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
        color: #84848d;
        /* width: 400%; */
        margin-left: 4%;
        padding-left: 15px;
        font-size: 1rem;
    }

    html::-webkit-scrollbar{
        width: 0.4rem;
        height: .5rem;
    }
    
    html::-webkit-scrollbar-track{
        background-color: transparent;
    }
    
    html::-webkit-scrollbar-thumb{
        background-color: #696cff;
        border-radius: 4px;
    }


    .signup-form-content{
        width: 100%;
        padding: 0 3%;
    }
    .text-fields.name::after{
        content: 'Name';
        background-color: #fff;
        position: relative;
        padding: 0 4%;
        left: -200px;
        color: #696cff;
        top: -28px;
        white-space: nowrap;
    }
    .text-fields.email::after{
        content: 'Email Address';
        background-color: #fff;
        position: relative;
        padding: 0 4%;
        left: -200px;
        color: #696cff;
        top: -28px;
        white-space: nowrap;
    }
    .text-fields.phone_no::after{
        content: 'Phone Number';
        background-color: #fff;
        position: relative;
        padding: 0 4%;
        left: -200px;
        color: #696cff;
        top: -28px;
        white-space: nowrap;
    }
    .text-fields.date_of_birth::after{
        content: 'Date Of Birth';
        background-color: #fff;
        position: relative;
        padding: 0 4%;
        left: -100px;
        color: #696cff;
        top: -28px;
        white-space: nowrap;
    }

    #date_of_birth{
        margin-right: -55px;
    }

    .text-fields.username::after{
        content: 'Username';
        background-color: #fff;
        position: relative;
        padding: 0 4%;
        left: -200px;
        color: #696cff;
        top: -28px;
        white-space: nowrap;
    }
    .text-fields.confirm_password::after{
        content: 'Password';
        background-color: #fff;
        position: relative;
        padding: 0 4%;
        left: -240px;
        color: #696cff;
        top: -28px;
        white-space: nowrap;
    }
    .khaskao{
        margin-top: 10px;
        margin-left: 170px;
        width: 290px;
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
    #my_list3{
        border: none;
        outline: none;
        background: inherit;
        color: #84848d;
        margin-top: 4px;
        font-size: 1rem;
    }
    .text-fields.bank_name::after{
        content: 'Bank Name';
        background-color: #fff;
        position: relative;
        padding: 0 4%;
        left: -200px;
        color: #696cff;
        top: -28px;
        white-space: nowrap;
    }
    .text-fields.bank_branch::after{
        content: 'Bank Branch';
        background-color: #fff;
        position: relative;
        padding: 0 4%;
        left: -200px;
        color: #696cff;
        top: -28px;
        white-space: nowrap;
    }
    .text-fields.account_holder_name::after{
        content: 'Account Holder Name';
        background-color: #fff;
        position: relative;
        padding: 0 4%;
        left: -200px;
        color: #696cff;
        top: -28px;
        white-space: nowrap;
    }
    .text-fields.account_number::after{
        content: 'Account Number';
        background-color: #fff;
        position: relative;
        padding: 0 4%;
        left: -200px;
        color: #696cff;
        top: -28px;
        white-space: nowrap;
    }
    .text-fields.account_type::after{
        content: 'Account Type';
        background-color: #fff;
        position: relative;
        padding: 0 4%;
        left: -250px;
        color: #696cff;
        top: -28px;
        white-space: nowrap;
    }

    
    .text-fields.bank_ifsc_code::after{
        content: 'IFSC Code';
        background-color: #fff;
        position: relative;
        padding: 0 4%;
        left: -220px;
        color: #696cff;
        top: -28px;
        white-space: nowrap;
    }
    .text-fields.bank_micr_code::after{
        content: 'MICR code';
        background-color: #fff;
        position: relative;
        padding: 0 4%;
        left: -220px;
        color: #696cff;
        top: -28px;
        white-space: nowrap;
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
        width: 300px;
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
        left: -280px;
        padding: 0 2%;
        color: #696cff;
        top: -28px;
        white-space: nowrap;
    }

    #proof_of_bank_account_ownership{
        cursor: pointer;
        padding-top: 5px;
    }

    .eye_icon{
        width: 25px;
        cursor: pointer;
        margin: 0 0 0 20px;
    }
    /* ========================================================================= */

    /* ========================================================================= */
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
        width: 4%;
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
    }

    .change_color{
        background: #ab65f8;
        transition: 0s all ease;
    }

    .change_color:hover{
        background: #2c3e50;
        color: white;
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
            <!-- <div>Hello From main_admin_dashboard_page_for_updating_faculty_record_from_admin</div><br> -->

            @if(Session()->has('update_faculty_record_msg'))

                <div class="msg" id="msg1">
                    {{session()->get('update_faculty_record_msg')}}
                    <button type="button" onclick = "document.getElementById('msg1').style.display = 'none';" id="popup-btn" >X</button>
                </div>

            @endif

            <div class="container">
                <div class="login-link" id = "loginLink">
                    <div class="logo">
                        <i class='bx bxs-objects-vertical-bottom'></i>
                        <span class="text">SCOREASY</span>
                    </div>
                    <p class="side-big-headning" style = "font-weight: 700; text-align: center;">Faculty User<br>Record Updation</p>
                    <p class="primary-bg-text">Update Faculty user record<br>With all the required Information</p>
                    <a onclick = " return confirm('Are you sure to Exit From The Updation of Faculty Record !'); " href="{{ route('main_admin_dashboard_show_faculties_page') }}" class="loginbtn">Exit</a>
                </div>
                <form action="{{ route('updating_faculty_user_record_from_admin_page_form_submission', $faculty_record_to_update_from_admin->id) }}" method = "post" class="signup-form-container" enctype="multipart/form-data">
                    @csrf
                    <p class="big-headning">Update Faculty Account</p>
                    <div class="progress-baranjali">
                        <div class="stage">
                            <p class="tool-tip">Personal Info</p>
                            <p class="stageno stageno-1">1</p>
                        </div>
                        <div class="stage">
                            <p class="tool-tip">Un & Ps</p>
                            <p class="stageno stageno-2">2</p>
                        </div>
                        <div class="stage">
                            <p class="tool-tip">Banking Info</p>
                            <p class="stageno stageno-3">3</p>
                        </div>
                        <div class="stage">
                            <p class="tool-tip">Submission</p>
                            <p class="stageno stageno-4">4</p>
                        </div>
                    </div>
                    <div class="signup-form-content">
                        <div class="stage1-content">
                            <div class="button-container">
                                <div class="text-fields name">
                                    <label for="name"><i class='bx bx-user-circle' style='color:#6487cb'></i></label>
                                    <input type="text" name="name" id="name" value = "{{ $faculty_record_to_update_from_admin->name }}" required>
                                </div>
                                <div class="text-fields email">
                                    <label for="email"><i class='bx bx-envelope' style='color:#6487cb'></i></label>
                                    <input type="text" name="email" id="email" value = "{{ $faculty_record_to_update_from_admin->email }}" required>
                                </div>
                            </div>
                            <div class="button-container">
                                <div class="text-fields phone_no">
                                    <label for="phone_no"><i class='bx bx-phone-call' style='color:#6487cb'></i></label>
                                    <input type="text" name="phone_no" id="phone_no" value = "{{ $faculty_record_to_update_from_admin->phone_no }}" required>
                                </div>
                                <div class="text-fields date_of_birth">
                                    <label for="date_of_birth"><i class='bx bx-calendar-event' style='color:#6487cb' ></i></label>
                                    <input type="date" name="date_of_birth" id="date_of_birth" value = "{{ $faculty_record_to_update_from_admin->date_of_birth }}" required>
                                </div>
                            </div>
                            <div class="pagination-btns">
                                <input type="button" value="Previous" class="previouspage stagebtn1a">
                                <input type="button" value="Next" class="nextpage stagebtn1b" onclick = "stage1to2()">
                            </div>
                        </div>
                        <div class="stage2-content">
                            <div class="button-container">
                                <div class="text-fields username" style = "width: 290px;">
                                    <label for="username"><i class='bx bxs-user' style='color:#6487cb'></i></label>
                                    <input type="text" name="username" id="username" value = "{{ $faculty_record_to_update_from_admin->username }}" required>
                                </div>
                                <div class="text-fields confirm_password" style = "width: 290px;">
                                    <label for="confirm_password"><i class='bx bxs-key' style='color:#6487cb' ></i></label>
                                    <input type="password" name="confirm_password" id="confirm_password" value = "{{ $faculty_record_to_update_from_admin->confirm_password }}" required>
                                    <img src="{{ asset('img/eye-close.png') }}" alt="eye-pic" class = "eye_icon" id = "eyeIcon">
                                </div>
                            </div>
                            <div class="pagination-btns">
                                <input type="button" value="Previous" class="previouspage stagebtn2a" onclick = "stage2to1()">
                                <input type="button" value="Next" class="nextpage stagebtn2b" onclick = "stage2to3()">
                            </div>
                        </div>
                        <div class="stage3-content">
                            <div class="button-container" style = "margin-top: -8px;">
                                <div class="text-fields bank_name" >
                                    <label for="bank_name"><i class='bx bxs-bank' style='color:#6487cb'></i></label>
                                    <input type="text" name="bank_name" id="bank_name" value = "{{ $faculty_record_to_update_from_admin->bank_name }}" required>
                                </div>
                                <div class="text-fields bank_branch" >
                                    <label for="bank_branch"><i class='bx bxs-doughnut-chart ' style='color:#6487cb'></i></label>
                                    <input type="text" name="bank_branch" id="bank_branch" value = "{{ $faculty_record_to_update_from_admin->bank_branch }}" required>
                                </div>
                            </div>

                            <div class="button-container">
                                <div class="text-fields bank_ifsc_code" >
                                    <label for="bank_ifsc_code"><i class='bx bxs-check-shield' style='color:#6487cb'></i></label>
                                    <input type="text" name="bank_ifsc_code" id="bank_ifsc_code" value = "{{ $faculty_record_to_update_from_admin->bank_ifsc_code }}" placeholder="Bank Account IFSC Code" required>
                                </div>
                                <div class="text-fields bank_micr_code" >
                                    <label for="bank_micr_code"><i class='bx bxs-check-shield' style='color:#6487cb'></i></label>
                                    <input type="text" name="bank_micr_code" id="bank_micr_code" value = "{{ $faculty_record_to_update_from_admin->bank_micr_code }}" placeholder="Bank Account MICR Code" required>
                                </div>
                            </div>

                            <div class="button-container">
                                <div class="text-fields account_holder_name">
                                    <label for="account_holder_name"><i class='bx bxs-user' style='color:#6487cb'></i></label>
                                    <input type="text" name="account_holder_name" id="account_holder_name" value = "{{ $faculty_record_to_update_from_admin->account_holder_name }}" required>
                                </div>
                                <div class="text-fields account_number">
                                    <label for="account_number"><i class='bx bxs-add-to-queue' style='color:#6487cb'></i></label>
                                    <input type="text" name="account_number" id="account_number" value = "{{ $faculty_record_to_update_from_admin->account_number }}" required>
                                </div>
                            </div>
                            <div class="button-container">
                                <div class="text-fields account_type">
                                    <label for="account_type"><i class='bx bxs-grid' style='color:#6487cb'></i></i></label>
                                    <select name="account_type" id="my_list4" required>
                                        <option value = "{{ $faculty_record_to_update_from_admin->account_type }}" selected>{{ $faculty_record_to_update_from_admin->account_type }}</option>
                                        <option value="Savings Account">Savings Account</option>
                                        <option value="Checking Account">Checking Account</option>
                                        <option value="Certificate of Deposit (CD) Account">Certificate of Deposit Account</option>
                                        <option value="Money Market Account">Money Market Account</option>
                                    </select>
                                </div>
                                <div class="file_uploader">
                                    <label for="proof_of_bank_account_ownership"><i  class='bx bxs-folder-open' style='color:#6487cb'></i></label>
                                    <input type="file" name="proof_of_bank_account_ownership" id="proof_of_bank_account_ownership">
                                </div>
                                <div class="file_uploader_heading">Proof of Bank Account Ownership</div>
                            </div>
                            <div class="pagination-btns" style = "margin-top: -25px; text-align: center;">
                                <a href="{{ route('document_viewer', ['id' => $faculty_record_to_update_from_admin->id]) }}" class = "nextpage stagebtn3a change_color" target="_blank">Click Here For Document</a>
                            </div>
                            <div class="pagination-btns" style = "margin-top: -40px;">
                                <input type="button" value="Previous" class="previouspage stagebtn3a" onclick = "stage3to2()">
                                <input type="button" value="Next" class="nextpage stagebtn3b" onclick = "stage3to4()">
                            </div>
                        </div>
                        <div class="stage4-content">
                            <div class="tc-container">
                                <label for="tc" class="tc" style="white-space: nowrap; margin-top: 50px;">
                                    <input type="checkbox" name="tc" id="tc" required>
                                    By submitting your details, you agree to the <a href="#">terms and conditions</a>
                                </label>
                            </div>
                            <br>
                            <div class="pagination-btns">
                                <input type="button" value="Previous" class="previouspage stagebtn4a" onclick = "stage4to3()">
                                <input type="submit" value="Update" class="nextpage stagebtn4b">
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
    // signUpContent5 = document.querySelector(".stage5-content");

    signUpContent2.style.display = "none"
    signUpContent3.style.display = "none"
    signUpContent4.style.display = "none"
    // signUpContent5.style.display = "none"
    previouspage.style.display = "none"

    function validateStage1() {
        // Validate stage 1 fields here
        var name = document.getElementById("name").value;
        var email = document.getElementById("email").value;
        var phone = document.getElementById("phone_no").value;
        var date_of_birth = document.getElementById("date_of_birth").value;

        if (name === "" || email === "" || phone === "" || date_of_birth === "") {
            alert("Please fill in all required fields in Stage 1");
            return false;
        }

        if (phone.length !== 13) {
            alert("Contry code is required with the phone number\n\nInvalid Mobile Number... please Count the digit or try again with contry code (+91)");
            return false;
        }

        return true;
    }

    function validateStage2() {
        // Validate stage 2 fields here: username, password, confirm_password
        var username = document.getElementById("username").value;
        var confirm_password = document.getElementById("confirm_password").value;

        if (username === "" || confirm_password === "") {
            alert("Please fill in all required fields in Stage 2");
            return false;
        }

        return true;
    }

    function validateStage3() {
        // Validate stage 4 fields here : bank_name, bank_branch, account_holder_name, account_number, proof_of_bank_account_ownership
        var bank_name = document.getElementById("bank_name").value;
        var bank_branch = document.getElementById("bank_branch").value;
        var account_holder_name = document.getElementById("account_holder_name").value;
        var account_number = document.getElementById("account_number").value;
        var account_type = document.getElementById("my_list4").value;

        if (bank_name === "" || bank_branch === "" || account_holder_name === "" || account_number === "" || account_type === "" ) {
            alert("Please fill in all required fields in Stage 4");
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
            // signUpContent5.style.display = "none";
            document.querySelector(".stageno-1").innerText = "✔";
            document.querySelector(".stageno-1").style.backgroundColor = "#52ec61";
        }
    }

    function stage2to1(){
        signUpContent1.style.display = "block"
        signUpContent3.style.display = "none"
        signUpContent2.style.display = "none"
        signUpContent4.style.display = "none"
        // signUpContent5.style.display = "none"
    }

    function stage2to3(){
        if (validateStage2()) {
            signUpContent1.style.display = "none"
            signUpContent3.style.display = "block"
            signUpContent2.style.display = "none"
            signUpContent4.style.display = "none"
            // signUpContent5.style.display = "none"
            document.querySelector(".stageno-2").innerText = "✔";
            document.querySelector(".stageno-2").style.backgroundColor = "#52ec61";
        }
    }

    function stage3to2(){
        signUpContent1.style.display = "none"
        signUpContent3.style.display = "none"
        signUpContent2.style.display = "block"
        signUpContent4.style.display = "none"
        // signUpContent5.style.display = "none"
    }

    function stage3to4(){
        if (validateStage3()) {
            signUpContent1.style.display = "none"
            signUpContent3.style.display = "none"
            signUpContent2.style.display = "none"
            signUpContent4.style.display = "block"
            // signUpContent5.style.display = "none"
            document.querySelector(".stageno-3").innerText = "✔";
            document.querySelector(".stageno-3").style.backgroundColor = "#52ec61";
        }
    }

    function stage4to3(){
        signUpContent1.style.display = "none"
        signUpContent3.style.display = "block"
        signUpContent2.style.display = "none"
        signUpContent4.style.display = "none"
        // signUpContent5.style.display = "none"
    }

    let eye_icon = document.getElementById("eyeIcon");
    let c_password = document.getElementById("confirm_password");

    eye_icon.onclick = function (){
        if(c_password.type == "password"){
            c_password.type = "text";
            // eye_icon2.src = "{{ asset('img/eye-open.png') }}";
            eye_icon2.src = "{{ asset('img/blue_eye_open_icon.png') }}";
        }else{
            c_password.type = "password";
            eye_icon2.src = "{{ asset('img/eye-close.png') }}";
        }
    }

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