<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\FacilityPhotoLike;
use App\Models\FacilityPhotoComment;
use App\Models\HogwartsProphetLike;
use App\Models\HogwartsProphetComment;
use App\Models\AchievementLike;
use App\Models\AchievementComment;

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

    // Relationships for likes
    public function facilityPhotoLikes()
    {
        return $this->hasMany(FacilityPhotoLike::class, 'user_id');
    }

    public function hogwartsProphetLikes()
    {
        return $this->hasMany(HogwartsProphetLike::class, 'user_id');
    }

    public function achievementLikes()
    {
        return $this->hasMany(AchievementLike::class, 'user_id');
    }

    // Relationships for comments
    public function facilityPhotoComments()
    {
        return $this->hasMany(FacilityPhotoComment::class, 'user_id');
    }

    public function hogwartsProphetComments()
    {
        return $this->hasMany(HogwartsProphetComment::class, 'user_id');
    }

    public function achievementComments()
    {
        return $this->hasMany(AchievementComment::class, 'user_id');
    }
}
