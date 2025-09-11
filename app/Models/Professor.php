<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    use HasFactory;

    // Mass assignment fields
    protected $fillable = [
        'name',
        'position',
        'subject',
        'house_id',
    ];

    /**
     * Relasi: Professor milik satu House
     */
    public function house()
    {
        return $this->belongsTo(House::class);
    }
}
