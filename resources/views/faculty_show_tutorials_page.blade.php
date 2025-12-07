@extends('faculty_dashboard_layout')

@section('style')
<style type="text/css">
    /* #Tutorials{
        border-left : 4px solid #3c748f;
        background: #b1cfde;
        border-radius: 4px;
    }    

    #Tutorials:hover{
        border-left: none;
        background: var(--primary-color);
    } */

    #Tutorials{
        border-left : 6px solid #305d72;
        background: #B7C9E2;
        border-radius: 4px;
    }    

    #Tutorials:hover{
        border-left: none;
        background: var(--primary-color);
    }

    body.dark #Tutorials{
        border-left : 6px solid white;
        background: #18191A;
        border-radius: 4px;
    }

    body.dark #Tutorials:hover{
        border-left: none;
        background: var(--primary-color);
    }
</style>
@endsection

@section('body')
<section class="home">
        <div class="text">Hello From faculty_show_tutorials_page</div>
</section>
@endsection