@extends('main_admin_dashboard_layout')

@section('title')
<title>Content Management</title>
@endsection

@section('style')
<style>
    #Tutorials{
        border-left : 6px solid #305d72;
        background: #B7C9E2;
        border-radius: 4px;
    } 

    #main-heading{
        color: #2C3E50;
        padding-bottom: 40px;
    }
    .center{
        text-align: center;
        padding-top: 70px;
        align-items: center;
        justify-content: center;
    }
    .form_container{
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    #form{
        border: 2px solid rgba(0,0,0,.2);
        box-shadow: 5px 5px 5px rgba(0,0,0,.2);
        padding : 0 80px;

        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    #text{
        margin-top: 40px;
        height: 50px;
        width: 400px;
        border: 1px solid rgba(0,0,0,.2);
        border-radius: 6px;
        padding: 25px;
        box-shadow: 5px 5px 5px rgba(0,0,0,.2);
        transition: 0.3s all ease;
    }
    #text:focus{
        border: 1px solid #616161;
        box-shadow: 3px 3px 3px #616161;
    }

    #btn{
        background: #8e44ad;
        border: none;
        color: white;
        height: 44px;
        width: 177.97px;
        margin-bottom: 40px;

        border-radius: 0.5rem;
        font-size: 20px;
        cursor: pointer;
        text-align: center;
        transition : 0.1s all ease;
    }

    #btn:hover{
        background: #2C3E50;
    }

    #my_list2{
        border: none;
        outline: none;
        background: inherit;
        color: #84848d;
        font-size: 1rem;
        color: #454545;
    }

    #ddl{
        display: flex;
        border: 1px solid #454545;
        padding: 5%;
        margin-top: 40px;
        width: 300px;
        height: 50px;
        align-items: center;
        text-align: center;
        justify-content: center;
        border-radius: 4px;
        color: #84848d;
    }

    #all_tutorials{
        border: 2px solid #3d5ee1;
        border-radius: 8px;
    }
</style>
@endsection


@section('body')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- <div>Hello From main_admin_dashboard_show_tutorials_page</div><br> -->

            @if(session('alert'))
                <script>
                    alert("{{ session('alert') }}");
                </script>
            @endif

            <div class="center">
                <h2 id="main-heading">Select Tutorial Type To Get All Tutorials</h2>

                <div class="form_container">
                    <form action="{{ route('video_pdf_show_tutorials_switching_route_at_admin') }}" method="POST" id="form">
                        @csrf
                        <div id="ddl">
                            <i class='bx bx-envelope' style='color:#8e44ad'></i>
                            <select name="tutorial_type" id="my_list2" required style="padding-left: 20px;">
                                <option value="" selected disabled>Select Tutorial Type&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>

                                    @foreach($all_tutorial_types as $each_tutorial_type)
                                        <option value="{{$each_tutorial_type->tutorial_type}}">{{$each_tutorial_type->tutorial_type}}</option>
                                    @endforeach

                            </select>
                        </div><br><br>
                        <input type="submit" value="Continue" id="btn">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection