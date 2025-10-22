<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HogwartsProphetLike extends Model
{
    protected $fillable = [
        'hogwarts_prophet_id',
        'user_id',
        'session_id',
        'ip_address',
    ];

    public function article()
    {
        return $this->belongsTo(HogwartsProphet::class, 'hogwarts_prophet_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
