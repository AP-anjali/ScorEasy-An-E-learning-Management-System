@extends('faculty_dashboard_layout')

@section('style')
<style type="text/css">
   #Update-Exam{
        border-left : 6px solid #305d72;
        background: #B7C9E2;
        border-radius: 4px;
    }    

    #Update-Exam:hover{
        border-left: none;
        background: var(--primary-color);
    }

    body.dark #Update-Exam{
        border-left : 6px solid white;
        background: #18191A;
        border-radius: 4px;
    }

    body.dark #Update-Exam:hover{
        border-left: none;
        background: var(--primary-color);
    }
</style>
@endsection

@section('body')
<section class="home">
        <div class="text">Hello From faculty_update_exam_page</div>
</section>
@endsection