<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HogwartsProphetComment extends Model
{
    protected $fillable = [
        'hogwarts_prophet_id',
        'user_id',
        'name',
        'content',
        'is_approved',
        'ip_address',
    ];

    protected $casts = [
        'is_approved' => 'boolean',
    ];

    public function article()
    {
        return $this->belongsTo(HogwartsProphet::class, 'hogwarts_prophet_id');
    }

    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
