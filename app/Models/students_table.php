<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class students_table extends Model
{
    public $table = 'students';
    public $primarykey = 'id';
    public $incrementing = true;
    public $timestamps = false;
}
