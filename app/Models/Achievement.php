<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'house_id',
        'date',
    ];

    protected $casts = [
        'date' => 'date',
    ];
    
    public function house()
    {
        return $this->belongsTo(House::class);
    }

}
