<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subjects_info_table extends Model
{
    public $table = 'subjects_info';
    public $primarykey = 'id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'admin_id',
        'selected_course_name',
        'selected_course_id',
        'subject_name',
        'subject_description',
    ];
}
