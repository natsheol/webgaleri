<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AchievementComment extends Model
{
    protected $fillable = [
        'achievement_id',
        'user_id',
        'name',
        'content',
        'is_approved',
        'ip_address',
    ];

    protected $casts = [
        'is_approved' => 'boolean',
    ];

    public function achievement()
    {
        return $this->belongsTo(Achievement::class, 'achievement_id');
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
