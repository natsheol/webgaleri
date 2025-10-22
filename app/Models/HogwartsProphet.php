<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class HogwartsProphet extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'writer',
        'date',
        'image',
        'slug', // tambahin ini
    ];

    // Biar slug otomatis kebentuk dari title
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($news) {
            if (empty($news->slug)) {
                $news->slug = Str::slug($news->title);
            }
        });

        static::updating(function ($news) {
            if ($news->isDirty('title')) {
                $news->slug = Str::slug($news->title);
            }
        });
    }

    public function likes()
    {
        return $this->hasMany(HogwartsProphetLike::class, 'hogwarts_prophet_id');
    }

    public function comments()
    {
        return $this->hasMany(HogwartsProphetComment::class, 'hogwarts_prophet_id');
    }

    public function approvedComments()
    {
        return $this->hasMany(HogwartsProphetComment::class, 'hogwarts_prophet_id')
                    ->where('is_approved', true)
                    ->orderBy('created_at', 'desc');
    }
}
