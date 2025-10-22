<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacilityCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'is_active',
        'sort_order',
        'cover_photo_id' // ID photo yang dijadikan cover
    ];

    // Semua photo (Admin)
    public function photos()
    {
        return $this->hasMany(FacilityPhoto::class, 'facility_category_id');
    }

    // Foto cover yang dipilih admin
    public function coverPhoto()
    {
        return $this->belongsTo(FacilityPhoto::class, 'cover_photo_id');
    }
}
