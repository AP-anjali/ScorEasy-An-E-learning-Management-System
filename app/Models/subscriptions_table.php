<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\admin_administration_table;

class subscriptions_table extends Model
{
    use HasFactory;

    public $table = 'subscriptions';
    public $primarykey = 'id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'admin_id',
        'subscription_name',
        'subscription_title',
        'subscription_discription',
        'subscription_price_without_discount',
        'subscription_price_with_discount',
        'subscription_duration_number',
        'subscription_duration_unit',
        'full_subscription_duration',

        'View_Videos_and_PDFs_access_boolean',
        'View_Videos_and_PDFs_access_limitation',
        'View_Videos_and_PDFs_access_limitation_number',

        'Download_Videos_and_PDFs_access_boolean',
        'Download_Videos_and_PDFs_access_limitation',
        'Download_Videos_and_PDFs_access_limitation_number',

        'Exams_access_boolean',
        'Exams_access_limitation',
        'Exams_access_limitation_number',

        'subscription_bg_color',
        'subscription_thumnail_image',
        'subscription_bg_pic',
        'subscription_status',
    ];

    public function admin()
    {
        return $this->belongsTo(admin_administration_table::class, 'admin_id');
    }
}
