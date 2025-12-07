<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\faculties_info_table;

class video_tutorials_info_table extends Model
{
    protected $table = 'video_tutorials_info';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;


    protected $fillable = [
        'faculty_id',
        'video_tutorial_url',
        'video_tutorial_Thumbnail_Image',
        'video_tutorial_title',
        'video_tutorial_description',
        'video_tutorial_selected_Language_id',
        'video_tutorial_selected_Language',
        'video_tutorial_keywords_or_tags',
        'video_tutorial_selected_course_id',
        'video_tutorial_selected_course_name',
        'video_tutorial_selected_subject_id',
        'video_tutorial_selected_subject_name',
        'video_tutorial_status',
        'video_tutorial_Duration_in_time',
        'video_tutorial_file_size',
        'tc',
    ];

    public function faculty()
    {
        return $this->belongsTo(faculties_info_table::class, 'faculty_id');
    }
}
