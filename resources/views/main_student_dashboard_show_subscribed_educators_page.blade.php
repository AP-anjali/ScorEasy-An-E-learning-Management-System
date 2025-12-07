@extends('main_student_dashboard_layout')

@section('title')
<title>Subscribed Educators</title>
@endsection

@section('style')
<style>
    #Content_Library{
        border-left : 6px solid #305d72;
        background: #B7C9E2;
        border-radius: 4px;
    } 

    #Subscribed_educators{
        border: 2px solid #3d5ee1;
        white-space: nowrap;
        border-radius: 8px;
    } 
</style>
@endsection


@section('body')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div>Hello From main_student_dashboard_show_subscribed_educators_page</div><br>
        </div>
    </div>
@endsection