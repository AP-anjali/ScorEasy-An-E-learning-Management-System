<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\students_info_table;

class students_feedbacks_table extends Model
{
    use HasFactory;

    public $table = 'students_feedbacks';
    public $primarykey = 'id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'student_id',
        'rating',
        'feedback',
    ];

    public function student()
    {
        return $this->belongsTo(students_info_table::class, 'student_id');
    }
}
