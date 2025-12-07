<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class faculties_info_table extends Model
{
    public $table = 'faculties_informations';
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
        'bank_name',
        'bank_branch',
        'bank_ifsc_code',
        'bank_micr_code',
        'account_holder_name',
        'account_number',
        'account_type',
        'proof_of_bank_account_ownership_file_name',
        'proof_of_bank_account_ownership_file_path',
    ];
}
