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

    #Subscriptions_page_preview{
        border: 2px solid #3d5ee1;
        border-radius: 8px;
    }

    #link_for_subscription_page_preview{
        background: #8e44ad;
        text-decoration: none;
        border-radius: 0.4rem;
        color: white;
        padding: 15px 6%;
        font-size: 20px;
        font-weight: 500;
        position: absolute;
        margin: 220px 0 0 25%;
        transition: 0.2s all ease;
        box-shadow: 3px 3px 3px rgba(0,0,0,.2);
    }

    #link_for_subscription_page_preview:hover{
        background: #2c3e50;
    }
</style>
@endsection


@section('body')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="forborder">
                <a href="{{ route('showing_all_Subscriptions_at_main_page') }}" target = "_blank" id = "link_for_subscription_page_preview">Click For Subscriptions Page Preview</a>
            </div>
        </div>
    </div>
@endsection