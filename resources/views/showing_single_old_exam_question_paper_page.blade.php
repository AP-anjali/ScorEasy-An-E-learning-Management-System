<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>{{ $old_exam_question_paper_to_display->material_title }}</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
   <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
   <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.3/css/bootstrap.min.css" integrity="sha512-oc9+XSs1H243/FRN9Rw62Fn8EtxjEYWHXRvjS43YtueEewbS6ObfXcJNyohjHqVKFPoXXUxwc+q1K7Dee6vv9g==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
   <link rel="stylesheet" href="{{ asset('cssfiles/main_initial_page.css') }}">
   <style>
        .row{
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        .play-video{
            flex-basis: 69%;
        }
        .video-right-sidebar{
            flex-basis: 30%;
        }
        .play-video video{
            width: 100%;
            border-radius: 15px;
            box-shadow: 1px 3px 10px rgba(0,0,0,0.2);
        }
        .play-video embed{
            width: 100%;
            border-radius: 15px;
            box-shadow: 1px 3px 10px rgba(0,0,0,0.2);
        }
        .play-video iframe{
            width: 100%;
            border-radius: 15px;
            box-shadow: 1px 3px 10px rgba(0,0,0,0.2);
        }
        .side-video-list{
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }
        .side-video-list img{
            width: 100%;
            box-shadow: 1px 3px 10px rgba(0,0,0,0.2);
            border-radius: 8px;
        }
        .side-video-list .small-video-thumbnail{
            flex-basis: 49%;
        }
        .side-video-list .video_other_info{
            flex-basis: 49%;
        }
        .play-video .video-tags a{
            color: #0000ff;
            font-size: 14px;
            margin-top: 2px;
        }
        .play-video h3{
            font-weight: 700;
            font-size: 22px;
        }
        .play-video .play-video-info{
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            margin-right: 20px;
            margin-top: 10px;
            font-size: 14px;
            color: #5a5a5a;
        }
        .play-video .play-video-info a img{
            width: 20px;
            margin-right: 8px;
        }
        .play-video .play-video-info a{
            display: inline-flex;
            align-items: center;
            margin-left: 15px;
            color: #454545;
        }
        .play-video hr{
            border: 0;
            height: 1px;
            background: #ccc;
            margin: 10px 0;
        }
        .publisher{
            display: flex;
            align-items: center;
            margin-top: 20px;
        }
        .publisher div{
            flex: 1;
            line-height: 18px;
        }
        .publisher div p{
            color : #000;
            font-weight: 600;
            font-size: 18px;
        }
        .publisher div span{
            font-size: 14px;
            margin-top: 2px;
            color: #5a5a5a;
        }
        .publisher button{
            background: #8e44ad;
            color: white;
            padding: 8px 30px;
            border: 0;
            outline: 0;
            border-radius: 4px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            margin-right: 5%;
        }

        .publisher button:hover{
            background: #2c3e50;
        }


        .video-desc-classs{
            padding-left: 55px;
            padding-right: 20px;
            margin: 15px 0;
        }
        .video-desc-classs p{
            font-size: 14px;
            margin-bottom: 5px;
            color: #5a5a5a;
            text-align: justify;
        }
        .video-desc-classs h4{
            font-size: 14px;
            color: #5a5a5a;
            margin-top: 15px;
        }
        .add-comment{
            display: flex;
            align-items: center;
            margin: 30px 0;
        }
        .add-comment img{
            width: 35px;
            border-radius: 50%;
            margin-right: 15px;
        }
        .add-comment input{
            border: 0;
            outline: 0;
            border-bottom: 1px solid #ccc;
            width: 100%;
            padding-top: 10px;
            font-size: 16px;
            background: transparent;
        }
        .existing-comments{
            display: flex;
            align-items: center;
            margin: 20px 0;
        }
        .existing-comments img{
            width: 35px;
            border-radius: 50%;
            margin-right: 15px;
        }
        .existing-comments h3{
            font-size: 14px;
            margin-bottom: 2px;
        }
        .existing-comments h3 span{
            font-size: 12px;
            color: #5a5a5a;
            font-weight: 600;
            margin-left: 8px;
        }
        .existing-comments .comment-actions{
            display: flex;
            align-items: center;
            margin: 8px 0;
            font-size: 14px;
        }
        .existing-comments .comment-actions img{
            border-radius: 0;
            width: 20px;
            margin-right: 5px;
        }
        .existing-comments .comment-actions span{
            margin-right: 20px;
            color: #5a5a5a;
        }
        .existing-comments .comment-actions .c_btn{
            color: #454545;
            padding: 2px 10px;
            background:white;
            box-shadow: 1px 3px 10px rgba(0,0,0,0.2);
            border-radius: 4px;
            margin-right: 20px;
            font-weight: 500;
        }
        .existing-comments .comment-actions .c_btn:hover{
            background: #454545;
            color: white;
        }

        .bas_have{
            display: flex;
            /* background: green; */
            margin-top: 4px;
        }

        .bas_bas_bas{
            margin-left: 8px;
        }

        .related_content_text{
            padding: 5px 0 5px 0;
            color: #5a5a5a;
            text-align: center;
            font-size: 16px;
            font-weight: 700;
        }

        .video-right-sidebar hr{
            border: 0;
            height: 1px;
            background: #ccc;
            margin: 10px 0;
        }

        @media(max-width: 900px){
            .play-video{
                flex-basis: 100%;
            }

            .video-right-sidebar{
                flex-basis: 100%;
            }

            .web_video_list_container{
                padding-left: 5%;
            }

            .video-desc-classs{
                padding-left: 0;
            }

            .play-video .play-video-info a{
                margin-left: 0;
                margin-right: 15px;
                margin-top: 15px;
            }

        }
   </style>
</head>
<body class = "active">

@include('website_menu')

<div class="web_video_list_container" style = "margin-top: 25px; margin-left: 8px;">
   <div class="row">
        <div class="play-video">
            <iframe src="{{ asset('storage/' . $old_exam_question_paper_to_display->material) }}#toolbar=0" type="application/pdf" width="100%" height="600px" frameborder="0"></iframe>

            <br>
            <h3 style = "margin-top: 20px;">{{ $old_exam_question_paper_to_display->material_title }}</h3>

            <hr>

            <div class="video-desc-classs">
                <p>{{ $old_exam_question_paper_to_display->material_description }}<p>
                <hr>
            </div>
        </div>
        <div class="video-right-sidebar">

            <h3 class = "related_content_text">Related Content</h3>
            <hr>

            @foreach($other_old_exam_question_papers as $other_pdf)
                <div class="side-video-list">
                    <a href="{{ route('Old_exam_question_paper_PDF', $other_pdf->id) }}" class="small-video-thumbnail"><img src="{{ asset('storage/' . $other_pdf->material_Thumbnail_Image) }}" alt="sidebar video thumbnail" ></a>
                    <div class="video_other_info">
                        <a href="{{ route('Old_exam_question_paper_PDF', $other_pdf->id) }}">{{ $other_pdf->material_title }}</a>
                    </div>
                </div>
            @endforeach

        </div>
   </div>
</div>

<section class="contact">
    <h2 style = "margin-top : 450px">Anjali Patel</h2>

</section>

@include('website_footer')

<!-- custom js file link  -->
<script src="{{ asset('js/main_initial_page.js') }}"></script>  
</body>
</html>