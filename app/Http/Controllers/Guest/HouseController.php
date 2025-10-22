<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\House;

class HouseController extends Controller
{
    public function show(House $house)
    {
        return view('guest.houses.show', compact('house'));
    }
}
