<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacilityPhoto extends Model
{
    use HasFactory;

    protected $fillable = ['facility_category_id', 'name', 'description', 'image'];

    public function category()
    {
        return $this->belongsTo(FacilityCategory::class, 'facility_category_id');
    }
}