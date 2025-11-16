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

    public function likes()
    {
        return $this->hasMany(AchievementLike::class, 'achievement_id');
    }

    public function comments()
    {
        return $this->hasMany(AchievementComment::class, 'achievement_id');
    }

    public function approvedComments()
    {
        return $this->hasMany(AchievementComment::class, 'achievement_id')
                    ->where('is_approved', true)
                    ->orderBy('created_at', 'desc');
    }

    public function house()
    {
        return $this->belongsTo(House::class);
    }
}

