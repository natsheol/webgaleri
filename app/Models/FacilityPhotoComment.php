<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacilityPhotoComment extends Model
{
    protected $fillable = [
        'facility_photo_id',
        'user_id',
        'name',
        'content',
        'is_approved',
        'ip_address',
    ];

    protected $casts = [
        'is_approved' => 'boolean',
    ];

    public function photo()
    {
        return $this->belongsTo(FacilityPhoto::class, 'facility_photo_id');
    }

    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
