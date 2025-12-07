<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\admin_administration_table;

class old_question_papers_table extends Model
{
    use HasFactory;

    public $table = 'old_question_papers';
    public $primarykey = 'id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'admin_id',
        'selected_course_name',
        'selected_course_id',
        'material',
        'material_Thumbnail_Image',
        'material_title',
        'material_description',
        'tc',
    ];

    public function admin()
    {
        return $this->belongsTo(admin_administration_table::class, 'admin_id');
    }
}
