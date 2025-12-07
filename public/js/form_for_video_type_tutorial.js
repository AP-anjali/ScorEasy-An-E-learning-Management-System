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
        var video_tutorial_Thumbnail_Image = document.getElementById("video_tutorial_Thumbnail_Image").files;
        var video_tutorial_title = document.getElementById("video_tutorial_title").value;
        var video_tutorial_description = document.getElementById("video_tutorial_description").value;

        if (video_tutorial_url === "" || video_tutorial_Thumbnail_Image.length === 0 || video_tutorial_title === "" || video_tutorial_description === "") {
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
       
        if (video_tutorial_selected_Language === "" || video_tutorial_keywords_or_tags === "" || video_tutorial_selected_course_name === "" || video_tutorial_selected_subject_name === "") {
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