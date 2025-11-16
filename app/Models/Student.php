<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public $incrementing = false; 
    protected $keyType = 'string'; 

    protected $fillable = [
        'id',
        'name',
        'house_id',
        'year',
        'photo',
        'birth_date',
    ];

    public function house()
    {
        return $this->belongsTo(House::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($student) {

            if (empty($student->id)) {
                $student->id = self::generateCustomId($student->year, $student->house_id);
            }
        });
    }

    private static function generateCustomId($year, $houseId)
    {
 
        $existingIds = self::where('year', $year)
            ->where('house_id', $houseId)
            ->pluck('id')
            ->filter()
            ->toArray();


        $usedNumbers = collect($existingIds)->map(function ($id) {
            return (int) substr($id, 4, 3); 
        })->filter()->sort()->values();


        $nextNumber = 1;
        foreach ($usedNumbers as $n) {
            if ($n == $nextNumber) {
                $nextNumber++;
            } else {
                break;
            }
        }


        $formattedNumber = str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
        $formattedHouse = str_pad($houseId, 2, '0', STR_PAD_LEFT);

        return "{$year}{$formattedNumber}{$formattedHouse}";
    }
}
