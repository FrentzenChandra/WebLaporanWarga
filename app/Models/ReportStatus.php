<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReportStatus extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'report_id',
        'image',
        'description',
        'status'
    ];

    public function Resident()
    {
        return $this->belongsTo(Report::class); // satu report status dimiliki oleh satu Resident
    }
}
