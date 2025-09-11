<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name', 'house_id', 'year', 'photo', 'birth_date',
    ];

    public function house()
    {
        return $this->belongsTo(House::class);
    }
}
