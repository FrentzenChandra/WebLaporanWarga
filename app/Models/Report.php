<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'code',
        'resident_id',
        'report_category_id',
        'title',
        'description',
        'image',
        'latitude',
        'longtitude',
        'address'
    ];

    public function resident()
    {
        return $this->belongsTo(Resident::class); // satu report dimiliki oleh satu resident
    }

    public function category() 
    {
        return $this->belongsTo(ReportCategory::class);
    }

    public function status()
    {
        return $this->hasMany(ReportStatus::class); // satu report memiliki banyak report status
    }
}
