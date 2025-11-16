<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// Relasi tambahan
use App\Models\FacilityPhotoLike;
use App\Models\FacilityPhotoComment;
use App\Models\HogwartsProphetLike;
use App\Models\HogwartsProphetComment;
use App\Models\AchievementLike;
use App\Models\AchievementComment;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'status',
        'last_login_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /* ==========================
     |  RELATIONSHIPS
     ========================== */


    public function facilityPhotoLikes()
    {
        return $this->hasMany(FacilityPhotoLike::class);
    }

    public function hogwartsProphetLikes()
    {
        return $this->hasMany(HogwartsProphetLike::class);
    }

    public function achievementLikes()
    {
        return $this->hasMany(AchievementLike::class);
    }

    public function facilityPhotoComments()
    {
        return $this->hasMany(FacilityPhotoComment::class);
    }

    public function hogwartsProphetComments()
    {
        return $this->hasMany(HogwartsProphetComment::class);
    }

    public function achievementComments()
    {
        return $this->hasMany(AchievementComment::class);
    }
}
