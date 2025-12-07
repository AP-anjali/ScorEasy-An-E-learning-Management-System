<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use App\Models\hero_image;
use App\Models\video_tutorials_info_table;
use App\Models\pdf_tutorials_info_table;
use Illuminate\Http\Request;

class MenuController extends Controller
{

    function main_initial_page(){
        $heroImage = hero_image::first();

        $videosPerPage = 15;
        $all_video_tutorial = video_tutorials_info_table::with('faculty')->limit($videosPerPage)->get();

        $PDFsPerPage = 15;
        $all_PDF_tutorial = pdf_tutorials_info_table::with('faculty2')->limit($PDFsPerPage)->get();
        return view('main_initial_page', compact('heroImage', 'all_video_tutorial', 'all_PDF_tutorial'));
    }

    function main_contact_page(){
        return view('main_contact_page');
    }

    function main_report_page(){
        return view('main_report_page');
    }

    function main_about_page(){
        return view('main_about_page');
    }


    function home()
    {
        return view('home');
    }

    function about()
    {
        return view('about');
    }

    function contact()
    {
        return view('contact');
    }

    function account()
    {
        
    }

    function help()
    {
        return view('help');
    }
}
