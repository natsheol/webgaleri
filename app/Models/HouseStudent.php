<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HouseStudent extends Model
{
    protected $fillable = [
        'house_id', 'year', 'total_students',
    ];

    public function house()
    {
        return $this->belongsTo(House::class, 'house_id');
    }
}
