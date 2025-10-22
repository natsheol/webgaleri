<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\FacilityPhotoLike;
use App\Models\FacilityPhotoComment;
use App\Models\HogwartsProphetLike;
use App\Models\HogwartsProphetComment;
use App\Models\AchievementLike;
use App\Models\AchievementComment;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'status',
        'last_login_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relationships for likes
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

    // Relationships for comments
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
