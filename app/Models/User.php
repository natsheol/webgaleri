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

    // Fields yang boleh diisi massal
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'status',
        'last_login_at',
    ];

    // Fields yang disembunyikan di JSON
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // CASTS untuk otomatis convert ke Carbon atau hashed password
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'password' => 'hashed',
    ];

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

    /* ==========================
     |  ACCESSORS (optional)
     |  Membuat Blade lebih bersih
     ========================== */

    // Format created_at
    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at ? $this->created_at->format('M d, Y') : '-';
    }

    // Last login in human-readable
    public function getLastLoginDiffAttribute()
    {
        return $this->last_login_at ? $this->last_login_at->diffForHumans() : 'Never';
    }
}
