<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class students_info_table extends Model
{
    public $table = 'students_info';
    public $primarykey = 'id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'name',
        'email',
        'phone_no',
        'date_of_birth',
        'username',
        'password',
        'confirm_password',
    ];
}
