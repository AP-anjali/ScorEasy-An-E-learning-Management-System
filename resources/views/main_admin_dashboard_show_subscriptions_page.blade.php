@extends('main_admin_dashboard_layout')

@section('title')
<title>Subscription Management</title>
@endsection

@section('style')
<style>
    #Subscriptions{
        border-left : 6px solid #305d72;
        background: #B7C9E2;
        border-radius: 4px;
    } 

    #All_Subscriptions{
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
        padding: 20px 10px;              /* yaha pe change karo is line me table ke data ki upar niche ki padding ke liye */
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
    #cat_table td:nth-child(21),
    #cat_table td:nth-child(22),
    #cat_table td:nth-child(23),
    #cat_table td:nth-child(24),
    #cat_table td:nth-child(25),
    #cat_table td:nth-child(26),
    #cat_table td:nth-child(27),
    #cat_table td:nth-child(28),
    #cat_table td:nth-child(29),
    #cat_table td:nth-child(30),
    #cat_table td:nth-child(31),
    #cat_table td:nth-child(32),
    #cat_table td:nth-child(33),
    #cat_table td:nth-child(34),
    #cat_table td:nth-child(35),
    #cat_table td:nth-child(36),
    #cat_table td:nth-child(37),
    #cat_table td:nth-child(38),
    #cat_table td:nth-child(39),
    #cat_table td:nth-child(40),
    #cat_table td:nth-child(41)
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
        font-weight: 500;
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
        margin-left: 25%;
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
            <!-- <div>Hello From main_admin_dashboard_show_subscriptions_page</div><br> -->

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

            @if(count($all_subscription) > 0)
            <div class="center">
                <h2 id="main-heading">All Subscriptions</h2>

                <div class="table_container">
                    <table id="cat_table">
                        <tr id="header_row">
                            <td>SR No.</td>
                            <td>Admin ID</td>
                            <td>Subscription ID</td>
                            <td>Subscription Name</td>
                            <td>Subscription Title</td>
                            <td>Subscription Description</td>
                            <td>Subscription price without discount</td>
                            <td>Subscription price with discount</td>
                            <td>Subscription Duration Number</td>
                            <td>Subscription Duration Unit</td>
                            <td>Full Subscription Duration</td>

                            <td>Subscription Videos & PDFs Access [Yes/No]</td>
                            <td>Subscription Videos & PDFs Access Restriction [Limited/Unlimited]</td>
                            <td>Subscription Videos & PDFs Access How Much [If Limited]</td>
                            
                            <td>Subscription Download Videos & PDFs [Yes/No]</td>
                            <td>Subscription Download Videos & PDFs Restriction [Limited/Unlimited]</td>
                            <td>Subscription Download Videos & PDFs How Much [If Limited]</td>

                            <td>Subscription Exams Attempts [Yes/No]</td>
                            <td>Subscription Exams Attempts Restriction [Limited/Unlimited]</td>
                            <td>Subscription Exams Attempts How Much [If Limited]</td>



                            <td>Subscription Background Color</td>
                            <td>Subscription Thumbnail Image</td>
                            <td>Subscription Background Image</td>
                            <td>Subscription Status</td>
                            <td>Record Created at</td>
                            <td>Record Updated at</td>
                            <td>To Edit Subscription Record</td>
                            <td>To Delete Subscription Record</td>
                        </tr>

                        @php
                            $srNo = 1; 
                        @endphp

                        @foreach($all_subscription as $each_subscription)
                            <tr id="all_rows">
                                <td>{{ $srNo++ }}</td>  
                                <td>{{ $each_subscription->admin_id }}</td>
                                <td>{{ $each_subscription->id }}</td>
                                <td>{{ $each_subscription->subscription_name }}</td>
                                <td>{{ $each_subscription->subscription_title }}</td>
                                <td>{{ $each_subscription->subscription_discription }}</td>
                                <td>{{ $each_subscription->subscription_price_without_discount }}</td>
                                <td>{{ $each_subscription->subscription_price_with_discount }}</td>
                                <td>{{ $each_subscription->subscription_duration_number }}</td>
                                <td>{{ $each_subscription->subscription_duration_unit }}</td>
                                <td>{{ $each_subscription->full_subscription_duration }}</td>

                                <td>{{ $each_subscription->View_Videos_and_PDFs_access_boolean ?? '-----------'  }}</td>
                                <td>{{ $each_subscription->View_Videos_and_PDFs_access_limitation ?? '-----------'  }}</td>
                                <td>{{ $each_subscription->View_Videos_and_PDFs_access_limitation_number ?? '-----------'  }}</td>

                                <td>{{ $each_subscription->Download_Videos_and_PDFs_access_boolean ?? '-----------'  }}</td>
                                <td>{{ $each_subscription->Download_Videos_and_PDFs_access_limitation ?? '-----------'  }}</td>
                                <td>{{ $each_subscription->Download_Videos_and_PDFs_access_limitation_number ?? '-----------'  }}</td>

                                <td>{{ $each_subscription->Exams_access_boolean ?? '-----------'  }}</td>
                                <td>{{ $each_subscription->Exams_access_limitation ?? '-----------'  }}</td>
                                <td>{{ $each_subscription->Exams_access_limitation_number ?? '-----------'  }}</td>


                                <td>{{ $each_subscription->subscription_bg_color }}</td>
                                
                                <td>
                                    <a href="{{ route('show_current_thumbnail_image_of_subscription_to_admin', ['id' => $each_subscription->id]) }}" target="_blank" id="document_btn">Click For Thumbnail</a>
                                </td>
                                <td>
                                    <a href="{{ route('show_current_background_image_of_subscription_to_admin', ['id' => $each_subscription->id]) }}" target="_blank" id="document_btn">Click For BG Image</a>
                                </td>
                                <td>{{ $each_subscription->subscription_status }}</td>
                                
                                <td>{{ $each_subscription->created_at }}</td>
                                <td>{{ $each_subscription->updated_at }}</td>
                                <td><a onclick="return confirm('Are you sure to Update selected Subscription Record !')" href="{{ route('main_admin_dashboard_update_subscription_page', $each_subscription->id) }}" id="edit_btn">Edit</a></td>
                                <td><a onclick="return confirm('Are you sure to Delete selected Subscription Record !')" href="{{ route('deleting_subscription_record_from_admin', $each_subscription->id) }}" id="delete_btn">Delete</a></td> 
                            </tr>
                        @endforeach

                    </table>
                </div>
            </div>
            @else
                <script>
                    window.location.href = '{{ route('main_admin_dashboard_nothing_to_show_in_subscription') }}';
                </script>
            @endif
        </div>
    </div>
@endsection