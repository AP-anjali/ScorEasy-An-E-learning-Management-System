@extends('main_student_dashboard_layout')

@section('title')
<title>Student Dashboard</title>
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
            <div>Hello From Main Student Dashboard</div><br>
            @if(isset($student_session))
                <h3 class="text">Hello, <b>{{ $student_session->name }}!</b>, You have the Student Power...</h3>
            @endif
        </div>
    </div>
@endsection