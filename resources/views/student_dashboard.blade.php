@extends('student_dashboard_layout')

@section('style')
<style type="text/css">
    /* #Dashboard{
        border-left : 4px solid #3c748f;
        background: #b1cfde;
        border-radius: 4px;
    }    

    #Dashboard:hover{
        border-left: none;
        background: var(--primary-color);
    } */

    #Dashboard{
        border-left : 6px solid #305d72;
        background: #B7C9E2;
        border-radius: 4px;
    }    

    #Dashboard:hover{
        border-left: none;
        background: var(--primary-color);
    }

    body.dark #Dashboard{
        border-left : 6px solid white;
        background: #18191A;
        border-radius: 4px;
    }

    body.dark #Dashboard:hover{
        border-left: none;
        background: var(--primary-color);
    }
</style>
@endsection

@section('body')
<section class="home">
        <div class="text">Hello From Student Dashboard</div>
</section>
@endsection