<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AchievementLike extends Model
{
    protected $fillable = [
        'achievement_id',
        'user_id',
        'session_id',
        'ip_address',
    ];

    public function achievement()
    {
        return $this->belongsTo(Achievement::class, 'achievement_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
