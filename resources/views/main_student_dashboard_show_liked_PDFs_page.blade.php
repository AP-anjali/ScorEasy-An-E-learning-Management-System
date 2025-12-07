@extends('main_student_dashboard_layout')

@section('title')
<title>Liked PDFs</title>
@endsection

@section('style')
<style>
    #Content_Library{
        border-left : 6px solid #305d72;
        background: #B7C9E2;
        border-radius: 4px;
    } 

    #Liked_PDFs{
        border: 2px solid #3d5ee1;
        border-radius: 8px;
    } 
</style>
@endsection


@section('body')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div>Hello From main_student_dashboard_show_liked_PDFs_page</div><br>
        </div>
    </div>
@endsection