@extends('main_admin_dashboard_layout')

@section('title')
<title>Content Management</title>
@endsection

@section('style')
<style>
    #Languages{
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
    /* .table_container{
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    } */

    #cat_table{
        /* margin: auto;
        width: 90%; */
        margin: 0 40px 0 40px;
        width: calc(100% - 80px);
        text-align: center;
        border-collapse: collapse; 
        border: 3px solid #454545;
        box-shadow: 5px 5px 5px #929292;
    }

    #cat_table td {
        padding: 10px; 
        border: 1px solid #454545;
    }

    #cat_table td:nth-child(1){
        width: 15%;
        white-space: nowrap;
    }

    #cat_table td:nth-child(2),
    #cat_table td:nth-child(3),
    #cat_table td:nth-child(4),
    #cat_table td:nth-child(5),
    #cat_table td:nth-child(6),
    #cat_table td:nth-child(7),
    #cat_table td:nth-child(8) {
        width: 100%; 
        white-space: nowrap;
    }

    #edit_btn{
        text-decoration: none;
        background: #F7F7FA; 
        color: #454545;
        font-weight: 500;
        border: 1px solid rgba(0,0,0,.2); 
        padding: 3% 16%;
        border-radius: 8px; 
        transition : 0s all ease;
    }

    #edit_btn:hover{
        color: black;
        border: 1px solid black; 
        font-weight: 500;
        background: #90EE90;
    }

    #delete_btn{
        text-decoration: none;
        font-weight: 500;
        background: #F7F7FA; 
        color: #454545;
        border: 1px solid rgba(0,0,0,.2); 
        padding: 3% 16%;
        border-radius: 8px; 
        transition : 0s all ease;
    }

    #delete_btn:hover{
        color: black;
        border: 1px solid black; 
        font-weight: 500;
        background: #FF7F7F;
    }

    #header_row{
        font-size: 16px; 
        font-weight: 500; 
        background: #929292; 
        color: black;
    }

    #header_row td{
        border: 3px solid #454545; 
    }

    #all_rows{
        background: #e4e4e4;
    }

    .msg{
        width: 50%;
        height: 50px;
        color: green;
        font-size: 20px;
        border-radius: 6px;
        padding: 8px 0 0 25px;
        background: white;
        border: 1px solid rgba(0,0,0,.2);
        box-shadow: 5px 5px 5px rgba(0,0,0,.2);
        margin-top: 20px;
        margin-left: 20px;
        align-items: center;
        justify-content: center;
    }

    #popup-btn{
        height: 80%;
        margin-bottom: 8px;
        width: 30px;
        padding-bottom: 4px;
        border: 1px solid rgba(0,0,0,.2);
        border-radius: 6px;
        background: rgba(0,0,0,.2);
        margin-left: 20%;
    }

    .page-wrapper{
        /* overflow-x: auto; */
        overflow: auto;
    }

    ::-webkit-scrollbar {
        width: 9px;
        height: 10px;
    }

    ::-webkit-scrollbar-thumb {
        background-color: #929292;
        border-radius: 10px;
    }

    ::-webkit-scrollbar-track {
        background: #B7C9E2;
    }

    ::-webkit-scrollbar-thumb:hover {
        background-color: #454545;
    }

    #All_Languages{
        border: 2px solid #3d5ee1;
        border-radius: 8px;
    }
</style>
@endsection


@section('body')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- <div>Hello From main_admin_dashboard_show_languages_page</div><br> -->

            @if(session('alert'))
                <script>
                    alert("{{ session('alert') }}");
                </script>
            @endif

            @if(Session()->has('message'))

                <div class="msg" id="msg1">
                    {{session()->get('message')}}
                    <button type="button" onclick = "document.getElementById('msg1').style.display = 'none';" id="popup-btn" >X</button>
                </div>

            @endif

            @if(count($all_languages) > 0)
                <div class="center">
                    <h2 id="main-heading">All Languages</h2>

                    <div class="table_container">
                        <table id="cat_table">
                            <tr id="header_row">
                                <td>SR No.</td>
                                <td>Language</td>
                                <td>Language Id</td>
                                <td>Admin Id</td>
                                <td>Added At</td>
                                <td>Updated At</td>
                                <td>To Edit Language</td>
                                <td>To Delete Language</td>
                            </tr>

                            @php
                                $srNo = 1; 
                            @endphp

                            @foreach($all_languages as $each_language)
                                <tr id="all_rows">
                                    <td>{{ $srNo++ }}</td>
                                    <td>{{$each_language->language_name}}</td>
                                    <td>{{$each_language->id}}</td>
                                    <td>{{$each_language->admin_id}}</td>
                                    <td>{{$each_language->created_at}}</td>
                                    <td>{{$each_language->updated_at}}</td>
                                    <td><a onclick="return confirm('Are you sure to Update selected Language !')" href="{{ url('main_admin_dashboard/main_admin_dashboard_update_language_page', $each_language->id) }}" id="edit_btn">Edit</a></td>
                                    <td><a onclick="return confirm('Are you sure to Delete selected Language !')" href="{{ url('main_admin_dashboard/delete_language', $each_language->id) }}" id="delete_btn">Delete</a></td> 
                                </tr>
                            @endforeach

                        </table>
                    </div>
                </div>
            @else
                <script>
                    window.location.href = '{{ route('main_admin_dashboard_nothing_to_show_in_language') }}';
                </script>
            @endif
        </div>
    </div>
@endsection