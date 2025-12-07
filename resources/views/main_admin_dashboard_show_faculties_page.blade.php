@extends('main_admin_dashboard_layout')

@section('title')
<title>Users Management</title>
@endsection

@section('style')
<style>
    #Users{
        border-left : 6px solid #305d72;
        background: #B7C9E2;
        border-radius: 4px;
    } 

    #all_faculty{
        border: 2px solid #3d5ee1;
        border-radius: 8px;
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
    .table_container{
        margin-bottom: 100px;
        padding: 0 30px;
    }

    #cat_table{
        margin: auto;
        width: 90%;
        text-align: center;
        border-collapse: collapse; 
        border: 3px solid #454545;
        box-shadow: 5px 5px 5px #929292;
    }

    #cat_table td {
        padding: 10px; 
        border: 1px solid #454545;
    }

    #cat_table td:nth-child(1),
    #cat_table td:nth-child(2),
    #cat_table td:nth-child(3),
    #cat_table td:nth-child(4),
    #cat_table td:nth-child(5),
    #cat_table td:nth-child(6),
    #cat_table td:nth-child(7),
    #cat_table td:nth-child(8),
    #cat_table td:nth-child(9),
    #cat_table td:nth-child(10),
    #cat_table td:nth-child(11),
    #cat_table td:nth-child(12),
    #cat_table td:nth-child(13),
    #cat_table td:nth-child(14),
    #cat_table td:nth-child(15),
    #cat_table td:nth-child(16),
    #cat_table td:nth-child(17),
    #cat_table td:nth-child(18),
    #cat_table td:nth-child(19),
    #cat_table td:nth-child(20),
    #cat_table td:nth-child(21)
    {
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
        background: #7dd181;
    }

    #document_btn{
        text-decoration: none;
        background: #F7F7FA; 
        color: #454545;
        font-weight: 500;
        border: 1px solid rgba(0,0,0,.2); 
        padding: 1.5% 16%;
        border-radius: 8px; 
        transition : 0s all ease;
    }

    #document_btn:hover{
        color: black;
        border: 1px solid black; 
        font-weight: 500;
        background: #ADD8E6;
    }

    #alert_btn{
        text-decoration: none;
        background: #F7F7FA; 
        color: #454545;
        font-weight: 500;
        border: 1px solid rgba(0,0,0,.2); 
        padding: 3% 16%;
        border-radius: 8px; 
        transition : 0s all ease;
    }

    #alert_btn:hover{
        color: black;
        border: 1px solid black; 
        font-weight: 500;
        background: #c595fa;
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
        margin-left: 33%;
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
</style>
@endsection


@section('body')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- <div>Hello From main_admin_dashboard_show_faculties_page</div><br> -->

            @if(Session()->has('delete_faculty_from_admin_route_msg'))

            <div class="msg" id="msg1">
                {{session()->get('delete_faculty_from_admin_route_msg')}}
                <button type="button" onclick = "document.getElementById('msg1').style.display = 'none';" id="popup-btn" >X</button>
            </div>

            @endif

            @if(count($all_faculties) > 0)
            <div class="center">
                <h2 id="main-heading">All Faculty Users</h2>

                <div class="table_container">
                    <table id="cat_table">
                        <tr id="header_row">
                            <td>SR No.</td>
                            <td>Faculty Name</td>
                            <td>Faculty ID</td>
                            <td>User Type</td>
                            <td>Faculty Email</td>
                            <td>Faculty Phone No.</td>
                            <td>Faculty DOB</td>
                            <td>Faculty Registered Date</td>
                            <td>Faculty Username</td>
                            <td>Faculty Password</td>
                            <td>Faculty Bank Name</td>
                            <td>Faculty Bank Branch Name</td>
                            <td>Faculty Bank Account Holder Name</td>
                            <td>Faculty Bank Account Number</td>
                            <td>Faculty Bank Account Type</td>
                            <td>Faculty Proof of Bank Account Ownership</td>
                            <td>Record Created at</td>
                            <td>Record Updated at</td>
                            <td>To Edit Faculty Record</td>
                            <td>To Alert to Faculty</td>
                            <td>To Delete Faculty Record</td>
                        </tr>

                        @php
                            $srNo = 1; 
                        @endphp

                        @foreach($all_faculties as $each_faculty)
                            <tr id="all_rows">
                                <td>{{ $srNo++ }}</td>  
                                <td>{{ $each_faculty->name }}</td>
                                <td>{{ $each_faculty->id }}</td>
                                <td>{{ $each_faculty->user_type }}</td>
                                <td>{{ $each_faculty->email }}</td>
                                <td>{{ $each_faculty->phone_no }}</td>
                                <td>{{ $each_faculty->date_of_birth }}</td>
                                <td>{{ $each_faculty->registration_date }}</td>
                                <td>{{ $each_faculty->username }}</td>
                                <td>{{ $each_faculty->confirm_password }}</td>
                                <td>{{ $each_faculty->bank_name }}</td>
                                <td>{{ $each_faculty->bank_branch }}</td>
                                <td>{{ $each_faculty->account_holder_name }}</td>
                                <td>{{ $each_faculty->account_number }}</td>
                                <td>{{ $each_faculty->account_type }}</td>
                                <td>
                                    <a href="{{ route('document_viewer', ['id' => $each_faculty->id]) }}" target="_blank" id="document_btn">Click For Document</a>
                                </td>

                                <td>{{ $each_faculty->created_at }}</td>
                                <td>{{ $each_faculty->updated_at }}</td>
                                <td><a onclick="return confirm('Are you sure to Update selected Faculty Record !')" href="{{ route('main_admin_dashboard_page_for_updating_faculty_record_from_admin', $each_faculty->id) }}" id="edit_btn">Edit</a></td>
                                <td><a href="#" id="alert_btn">Alert</a></td>
                                <td><a onclick="return confirm('Are you sure to Delete selected Faculty Record !')" href="{{ route('deleting_faculty_record_from_admin', $each_faculty->id) }}" id="delete_btn">Delete</a></td> 
                            </tr>
                        @endforeach

                    </table>
                </div>
            </div>
            @else
                <script>
                    window.location.href = '{{ route('main_admin_dashboard_nothing_to_show_in_faculties_record') }}';
                </script>
            @endif
        </div>
    </div>
@endsection