<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TourItinerary extends Model
{
    protected $fillable = [
        'tour_package_id',
        'day_number',
        'time',
        'title',
        'description',
    ];

    public function tourPackage()
    {
        return $this->belongsTo(TourPackage::class);
    }
}
