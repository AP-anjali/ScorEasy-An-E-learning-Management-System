@extends('main_student_dashboard_layout')

@section('title')
<title>Progress Charts</title>
@endsection

@section('style')
<style>
    #Progress{
        border-left : 6px solid #305d72;
        background: #B7C9E2;
        border-radius: 4px;
    } 

    #Progress_Charts{
        border: 2px solid #3d5ee1;
        border-radius: 8px;
    } 
</style>
@endsection


@section('body')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div>Hello From main_student_dashboard_show_progress_chart_page</div><br>
        </div>
    </div>
@endsection