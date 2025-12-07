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
        var subject_name = document.getElementById("subject_name").value;
       
        if (subject_name === "") {
            alert("Please fill in all required fields in Stage 2");
            return false;
        }

        return true;
    }

    function validateStage3() {
        var subject_description = document.getElementById("subject_description").value;

        if (subject_description === "") {
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

    document.addEventListener('DOMContentLoaded', function() {
        var textFields = document.querySelectorAll('.text-fields input');
        var custometextFields = document.querySelectorAll('.custome-text-fields textarea');

        textFields.forEach(function(input) {
            input.addEventListener('focus', function() {
                this.parentElement.style.borderColor = '#696cff';
            });

            input.addEventListener('blur', function() {
                this.parentElement.style.borderColor = ''; // Reset to default border color
            });
        });

        custometextFields.forEach(function(input) {
            input.addEventListener('focus', function() {
                this.parentElement.style.borderColor = '#696cff';
            });

            input.addEventListener('blur', function() {
                this.parentElement.style.borderColor = ''; // Reset to default border color
            });
        });
    });