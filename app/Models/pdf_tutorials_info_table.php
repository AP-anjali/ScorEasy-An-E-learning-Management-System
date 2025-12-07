<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\faculties_info_table;


class pdf_tutorials_info_table extends Model
{
    use HasFactory;

    protected $table = 'pdf_tutorials_info';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'faculty_id',
        'PDF_tutorial_path',
        'PDF_tutorial_Thumbnail_Image',
        'PDF_tutorial_title',
        'PDF_tutorial_description',
        'PDF_tutorial_selected_Language_id',
        'PDF_tutorial_selected_Language',
        'PDF_tutorial_keywords_or_tags',
        'PDF_tutorial_selected_course_id',
        'PDF_tutorial_selected_course_name',
        'PDF_tutorial_selected_subject_id',
        'PDF_tutorial_selected_subject_name',
        'PDF_tutorial_status',
        'PDF_tutorial_page_numbers',
        'PDF_tutorial_file_size',
        'tc',
    ];

    public function faculty2()
    {
        return $this->belongsTo(faculties_info_table::class, 'faculty_id');
    }
}
