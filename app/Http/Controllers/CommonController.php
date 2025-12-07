<?php

namespace App\Http\Controllers;
use App\Models\old_question_papers_table;
use Illuminate\Support\Facades\Session;
use App\Models\video_tutorials_info_table;
use App\Models\pdf_tutorials_info_table;
use App\Models\subscriptions_table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Dompdf\Dompdf;
use Dompdf\Options;
use PDF;
use Dompdf\Encoding;
use setasign\Fpdi\Fpdi;
use Barryvdh\DomPDF\Facade as PdfKeVaste;
use Org_Heigl\Ghostscript\Ghostscript;
use Spatie\PdfToImage\Pdf as TryTest;
use Intervention\Image\ImageManagerStatic as Image;

class CommonController extends Controller
{

    public function test_for_displaying_limited_pages_of_pdf($id)
    {
        $logged_in_student_user = Session::get('student_session');
    
        $pdf_to_display = pdf_tutorials_info_table::find($id);
        $pdf_path = $pdf_to_display->PDF_tutorial_path;
    
        $imageDirectory = public_path('storage/extracted_images_of_pdf');
        if (!is_dir($imageDirectory)) {
            mkdir($imageDirectory, 0777, true);
            chmod($imageDirectory, 0777);
        }

        $pdf_file = public_path('storage/' . $pdf_path);
        $imagePath = $imageDirectory . "\\image%d";
        Ghostscript::setGsPath("C:\Program Files\gs\gs10.02.1\bin\gswin64c.exe");
        $images = [];
        $ghostscript = new Ghostscript();

        for ($page = 1; $page <= 5; $page++) {
            $imagePath = $imageDirectory . "\\image{$page}.png";
            $ghostscript->setInputFile($pdf_file)
                        ->setResolution(300)
                        ->setPages($page)
                        ->setOutputFile($imagePath)
                        ->render();
            $images[] = $imagePath;
        }

        dd($images);die;

        return view('test_for_displaying_limited_pages_of_pdf', compact('images'));
    }

    
    public function generatePdfFromImages($images)
    {
        // Initialize an empty PDF instance
        $pdf = new Dompdf();
    
        foreach ($images as $image) {
            $html = view('pdf.image', ['image' => $image])->render();

            // Load HTML to Dompdf
            $pdf->loadHtml($html);

            // (Optional) Add a page break after each image except the last one
            if ($image !== end($images)) {
                $pdf->addPage();
            }
        }

        $pdf->setPaper('A4', 'portrait');

        // Render PDF
        $pdf->render();

        echo "END";die;
    }

    public function missing_internet_connection()
    {
        return view('missing_internet_connection');
    }

    public function page_not_found()
    {
        return view('page_not_found');
    }

    public function UPSC_Old_Exam_Papers()
    {
        $All_UPSC_EXAM_OLD_QUESTION_PAPERS = old_question_papers_table::where('selected_course_name', 'UPSC')->with('admin')->get();
        return view('UPSC_Old_Exam_Papers', compact('All_UPSC_EXAM_OLD_QUESTION_PAPERS'));
    }

    public function GPSC_Old_Exam_Papers()
    {
        $All_GPSC_EXAM_OLD_QUESTION_PAPERS = old_question_papers_table::where('selected_course_name', 'GPSC')->with('admin')->get();
        return view('GPSC_Old_Exam_Papers', compact('All_GPSC_EXAM_OLD_QUESTION_PAPERS'));
    }

    public function showing_all_video_tutorials_at_main_page()
    {
        $all_video_tutorial = video_tutorials_info_table::all();
        return view('showing_all_video_tutorials_at_main_page', compact('all_video_tutorial'));
    }

    public function showing_all_PDF_tutorials_at_main_page()
    {
        $all_PDF_tutorial = pdf_tutorials_info_table::all();
        return view('showing_all_PDF_tutorials_at_main_page', compact('all_PDF_tutorial'));
    }

    public function showing_only_UPSC_content()
    {
        $videosPerPage = 15;
        $all_video_tutorial = video_tutorials_info_table::with('faculty')->where('video_tutorial_selected_course_name', 'UPSC')->limit($videosPerPage)->get();

        $PDFsPerPage = 15;
        $all_PDF_tutorial = pdf_tutorials_info_table::with('faculty2')->where('PDF_tutorial_selected_course_name', 'UPSC')->limit($PDFsPerPage)->get();

        return view('showing_only_UPSC_content', compact('all_video_tutorial', 'all_PDF_tutorial'));
    }

    public function showing_only_GPSC_content()
    {
        $videosPerPage = 15;
        $all_video_tutorial = video_tutorials_info_table::with('faculty')->where('video_tutorial_selected_course_name', 'GPSC')->limit($videosPerPage)->get();

        $PDFsPerPage = 15;
        $all_PDF_tutorial = pdf_tutorials_info_table::with('faculty2')->where('PDF_tutorial_selected_course_name', 'GPSC')->limit($PDFsPerPage)->get();

        return view('showing_only_GPSC_content', compact('all_video_tutorial', 'all_PDF_tutorial'));
    }

    public function video($id)
    {
        $video_tutorial_to_display = video_tutorials_info_table::find($id);
        $other_videos = video_tutorials_info_table::where('id', '!=', $id)->get();

        $student_session = Session::get('student_session');

        if($student_session)
        {
            return view('showing_single_video_tutorial_page', compact('video_tutorial_to_display', 'other_videos', 'student_session'));
        }
        else
        {
            return view('showing_single_video_tutorial_page', compact('video_tutorial_to_display', 'other_videos'));          
        }
    }

    public function PDF($id)
    {
        $pdf_tutorial_to_display = pdf_tutorials_info_table::with('faculty2')->find($id);
        $other_pdfs = pdf_tutorials_info_table::where('id', '!=', $id)->with('faculty2')->get();
        return view('showing_single_pdf_tutorial_page', compact('pdf_tutorial_to_display', 'other_pdfs'));
    } 
    
    public function Old_exam_question_paper_PDF($id)
    {
        $old_exam_question_paper_to_display = old_question_papers_table::find($id);
        $other_old_exam_question_papers = old_question_papers_table::where('id', '!=', $id)->get();
        return view('showing_single_old_exam_question_paper_page', compact('old_exam_question_paper_to_display', 'other_old_exam_question_papers'));
    }

    function showing_all_Subscriptions_at_main_page()
    {
        $all_subscription = subscriptions_table::all();

        $student_session = Session::get('student_session');

        if($student_session)
        {
            return view('showing_all_Subscriptions_at_main_page', compact('all_subscription', 'student_session'));
        }
        else
        {
            return view('showing_all_Subscriptions_at_main_page', compact('all_subscription'));           
        }
        
    }

    public function common_page_nothing_to_show_in_subscriptions_page(){
        return view('common_page_nothing_to_show_in_subscriptions_page');
    }

    public function Subscription($id){

        $subscription_to_display = subscriptions_table::find($id);
        $other_subscriptions = subscriptions_table::where('id', '!=', $id)->get();

        $student_session = Session::get('student_session');

        if($student_session)
        {
            return view('showing_single_Subscription_at_main_page', compact('subscription_to_display', 'other_subscriptions', 'student_session'));
        }
        else
        {
            return view('showing_single_Subscription_at_main_page', compact('subscription_to_display', 'other_subscriptions'));            
        }

    }

    public function contact_us_page_for_subscription()
    {
        return view('contact_us_page_for_subscription');
    }

    public function Subscription_Comparision($id)
    {
        $subscription_to_compare = subscriptions_table::find($id);
        $other_subscriptions = subscriptions_table::where('id', '!=', $id)->get();

        $student_session = Session::get('student_session');

        if($student_session)
        {
            return view('Compare_particullar_Subscription_with_others_Page', compact('subscription_to_compare', 'other_subscriptions', 'student_session'));
        }
        else
        {
            return view('Compare_particullar_Subscription_with_others_Page', compact('subscription_to_compare', 'other_subscriptions'));          
        }
    }
}

// ============================= finally :) =========================

// public function test_for_displaying_limited_pages_of_pdf($id)
// {
//     // Retrieve the currently logged-in user
//     $logged_in_student_user = Session::get('student_session');

//     $pdf_to_display = pdf_tutorials_info_table::find($id);
//     $pdf_path = $pdf_to_display->PDF_tutorial_path;

//     // Ensure that the directory exists and is writable
//     $imageDirectory = public_path('storage/extracted_images_of_pdf');
//     if (!is_dir($imageDirectory)) {
//         mkdir($imageDirectory, 0777, true);
//         chmod($imageDirectory, 0777); // Set directory permissions
//     }

//     // Get the PDF file contents
//     $pdfContents = Storage::disk('public')->get($pdf_path);

//     // Explicitly set the character encoding to UTF-8
//     $pdfContents = mb_convert_encoding($pdfContents, 'HTML-ENTITIES', 'UTF-8');

//     // Load PDF from contents
//     $pdf = PDF::loadHtml($pdfContents);

//     // Get total number of pages in the PDF
//     $totalPages =  $this->getPdfPageCount(storage_path('app/public/' . $pdf_path));

//     // Array to store image paths
//     $images = [];

//     // Determine the number of pages to convert to images (limited to 5 or total pages)
//     $numPagesToConvert = min($totalPages, 5);

//     // Convert pages to images
//     for ($pageNumber = 1; $pageNumber <= $numPagesToConvert; $pageNumber++) {

//         $pdf_file = public_path('storage/' . $pdf_path);
//         $imagePath = $imageDirectory . '/page_' . $pageNumber . '.png';
//         Ghostscript::setGsPath("C:\Program Files\gs\gs10.02.1\bin\gswin64c.exe");
//         $ghostscript = new Ghostscript();

//         // Convert PDF to images and save them
//         $ghostscript->setInputFile($pdf_file)
//             ->setResolution(300) 
//             ->setPages([$pageNumber]) // Specify the page number
//             ->setOutputFile($imagePath) 
//             ->render();

//         chmod($imagePath, 0777); // Set file permissions

//         $images[] = $imagePath;
//     }

//     // Return view with image paths
//     return view('test_for_displaying_limited_pages_of_pdf', compact('images'));
// }

// private function getPdfPageCount($pdfPath)
// {
//     $content = File::get($pdfPath);
//     $numMatches = preg_match_all("/\/Page\W/", $content, $dummy);
//     return $numMatches;
// }


// ------------------------- aa function thi pdf na badha pages image ma convert thay chhe ------------------------------------
    // public function test_for_displaying_limited_pages_of_pdf($id)
    // {
    //     $logged_in_student_user = Session::get('student_session');
    
    //     $pdf_to_display = pdf_tutorials_info_table::find($id);
    //     $pdf_path = $pdf_to_display->PDF_tutorial_path;
    
    //     // Ensure that the directory exists and is writable
    //     $imageDirectory = public_path('storage/extracted_images_of_pdf');
    //     if (!is_dir($imageDirectory)) {
    //         mkdir($imageDirectory, 0777, true);
    //         chmod($imageDirectory, 0777); // Set directory permissions
    //     }

    //     $pdf_file = public_path('storage/' . $pdf_path);
    //     $imagePath = $imageDirectory . "\\image%d";
    //     Ghostscript::setGsPath("C:\Program Files\gs\gs10.02.1\bin\gswin64c.exe");
    //     $ghostscript = new Ghostscript();

    //     // Convert PDF to images and save them
    //     $ghostscript->setInputFile($pdf_file)->setResolution(300)->setOutputFile($imagePath)->render();

    //     echo "bassssssssssssss";die;

    //     return view('test_for_displaying_limited_pages_of_pdf', compact('images'));
    // }

// ======================================= finally ho gaya sab kuch, jaise chahiye tha vaisa ======================
//     public function test_for_displaying_limited_pages_of_pdf($id)
//     {
//         $logged_in_student_user = Session::get('student_session');
    
//         $pdf_to_display = pdf_tutorials_info_table::find($id);
//         $pdf_path = $pdf_to_display->PDF_tutorial_path;
    
//         // Ensure that the directory exists and is writable
//         $imageDirectory = public_path('storage/extracted_images_of_pdf');
//         if (!is_dir($imageDirectory)) {
//             mkdir($imageDirectory, 0777, true);
//             chmod($imageDirectory, 0777); // Set directory permissions
//         }

//         $pdf_file = public_path('storage/' . $pdf_path);
//         $imagePath = $imageDirectory . "\\image%d";
//         Ghostscript::setGsPath("C:\Program Files\gs\gs10.02.1\bin\gswin64c.exe");
//         $images = [];
//         $ghostscript = new Ghostscript();

//         // Convert each page to an image and store it
//         for ($page = 1; $page <= 5; $page++) {
//             $imagePath = $imageDirectory . "\\image{$page}.jpg";
//             $ghostscript->setInputFile($pdf_file)
//                         ->setResolution(300)
//                         ->setPages($page)
//                         ->setOutputFile($imagePath)
//                         ->render();
//             $images[] = $imagePath;
//         }

//         return view('test_for_displaying_limited_pages_of_pdf', compact('images'));
//     }