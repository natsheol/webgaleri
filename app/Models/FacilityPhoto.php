<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacilityPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'facility_category_id',
        'name',
        'description',
        'image',
        'view_count'
    ];

    public function category()
    {
        return $this->belongsTo(FacilityCategory::class, 'facility_category_id');
    }

    public function likes()
    {
        return $this->hasMany(FacilityPhotoLike::class, 'facility_photo_id');
    }

    public function comments()
    {
        return $this->hasMany(FacilityPhotoComment::class, 'facility_photo_id');
    }

    public function approvedComments()
    {
        return $this->hasMany(FacilityPhotoComment::class, 'facility_photo_id')
                    ->where('is_approved', true)
                    ->orderBy('created_at', 'desc');
    }
}
