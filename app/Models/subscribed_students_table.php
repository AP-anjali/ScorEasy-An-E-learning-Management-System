<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\students_info_table;
use App\Models\subscriptions_table;

class subscribed_students_table extends Model
{
    use HasFactory;

    public $table = 'subscribed_students';
    public $primarykey = 'id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'student_id',
        'total_amount',
        'transaction_id',
        'payment_id',
        'payment_status',
        'payment_info',
        'subscription_id',
        'subscription_start_date',
        'subscription_end_date',
    ];

    public function student()
    {
        return $this->belongsTo(students_info_table::class, 'student_id');
    }

    public function subscription()
    {
        return $this->belongsTo(subscriptions_table::class, 'subscription_id');
    }

}
