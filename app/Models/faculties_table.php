<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class faculties_table extends Model
{
    public $table = 'faculties';
    public $primarykey = 'id';
    public $incrementing = true;
    public $timestamps = false;
}
