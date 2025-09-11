<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'gender',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Accessor untuk nama formal
    public function getFormalNameAttribute()
    {
        $prefix = $this->gender === 'L' ? 'Mr. ' : 'Ms. ';
        return $prefix . $this->name;
    }
}
