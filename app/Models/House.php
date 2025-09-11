<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    protected $fillable = [
        'name', 'slug', 'logo', 'description', 'characteristics',
    ];

    protected $casts = [
        'characteristics' => 'array',
    ];

    public function students()
    {
        return $this->hasMany(HouseStudent::class, 'house_id');
    }

    public function professors()
    {
        return $this->hasMany(Professor::class);
    }

    public function realStudents()
    {
        return $this->hasMany(Student::class, 'house_id');
    }

    public function achievements()
    {
        return $this->hasMany(Achievement::class);
    }

    public function studentsRelation()
    {
        return $this->hasMany(Student::class);
    }

}
