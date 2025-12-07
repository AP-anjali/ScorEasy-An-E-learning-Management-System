@extends('main_student_dashboard_layout')

@section('title')
<title>My Schedule</title>
@endsection

@section('style')
<style>
    #Agile_Agenda{
        border-left : 6px solid #305d72;
        background: #B7C9E2;
        border-radius: 4px;
    } 

    #My_Schedule{
        border: 2px solid #3d5ee1;
        border-radius: 8px;
    } 
</style>
@endsection


@section('body')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- <div>Hello From main_student_dashboard_show_my_schedule_page</div><br> -->

            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <title>To Do List</title>
                <!-- Font Awesome Icons -->
                <link
                rel="stylesheet"
                href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
                />
                <!-- Google Fonts -->
                <link
                href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap"
                rel="stylesheet"
                />
                <!-- Stylesheet -->
                <link rel="stylesheet" href="{{ asset('cssfiles/main_student_dashboard_show_my_schedule_page.css') }}" />
            </head>
            <body>
                <div class="containermy">
                    <div id="new-task">
                        <input type="text" placeholder="Enter The Task Here..." />
                        <button id="push">Add</button>
                    </div>
                    <div id="tasks" class = "to_do_body"></div>
                </div>
                <!-- Script -->
                <script src="{{ asset('js/main_student_dashboard_show_my_schedule_page.js') }}"></script>
            </body>
            </html>


        </div>
    </div>
@endsection