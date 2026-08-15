<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TourPickupPoint extends Model
{
    protected $fillable = [
        'tour_package_id',
        'location_name',
        'order',
    ];

    public function tourPackage()
    {
        return $this->belongsTo(TourPackage::class);
    }
}
