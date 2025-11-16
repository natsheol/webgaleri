<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Founder extends Model
{
    protected $fillable = [
        'school_profile_id',
        'name',
        'birth_year',
        'photo',
        'description',
        'school_profile_id'
    ];

    public function schoolProfile()
    {
        return $this->belongsTo(SchoolProfile::class);
    }
}
