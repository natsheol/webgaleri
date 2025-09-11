<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacilityCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'is_active', 'sort_order'];

    public function photos()
    {
        return $this->hasMany(FacilityPhoto::class, 'facility_category_id');
    }
}
