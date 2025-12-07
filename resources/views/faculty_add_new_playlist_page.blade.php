@extends('faculty_dashboard_layout')

@section('style')
<style type="text/css">
     #Add-New-Playlist{
        border-left : 6px solid #305d72;
        background: #B7C9E2;
        border-radius: 4px;
    }    

    #Add-New-Playlist:hover{
        border-left: none;
        background: var(--primary-color);
    }

    body.dark #Add-New-Playlist{
        border-left : 6px solid white;
        background: #18191A;
        border-radius: 4px;
    }

    body.dark #Add-New-Playlist:hover{
        border-left: none;
        background: var(--primary-color);
    }
</style>
@endsection

@section('body')
<section class="home">
        <div class="text">Hello From faculty_add_new_playlist_page</div>
</section>
@endsection