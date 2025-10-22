<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacilityPhotoLike extends Model
{
    protected $fillable = [
        'facility_photo_id',
        'user_id',
        'session_id',
        'ip_address',
    ];

    public function photo()
    {
        return $this->belongsTo(FacilityPhoto::class, 'facility_photo_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
