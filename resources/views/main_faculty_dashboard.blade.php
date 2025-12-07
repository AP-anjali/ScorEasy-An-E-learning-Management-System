@extends('main_faculty_dashboard_layout')

@section('title')
<title>Faculty Dashboard</title>
@endsection

@section('style')
<style>
    #Dashboard{
        border-left : 6px solid #305d72;
        background: #B7C9E2;
        border-radius: 4px;
    } 
</style>
@endsection


@section('body')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div>Hello From Main Faculty Dashboard</div><br>
            @if(isset($faculty_session))
                <h3 class="text">Hello, <b>{{ $faculty_session->name }}!</b>, You have the Faculty Power...</h3>
            @endif
        </div>
    </div>
@endsection