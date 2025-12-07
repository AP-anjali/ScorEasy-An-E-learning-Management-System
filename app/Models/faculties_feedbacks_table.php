<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\faculties_info_table;

class faculties_feedbacks_table extends Model
{
    use HasFactory;

    public $table = 'faculties_feedbacks';
    public $primarykey = 'id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'faculty_id',
        'rating',
        'feedback',
    ];

    public function faculty()
    {
        return $this->belongsTo(faculties_info_table::class, 'faculty_id');
    }
}
