<?php

namespace App\Http\Controllers;

use App\Models\HogwartsProphet;

class HomeController extends Controller
{
    public function index()
    {
        $latestArticles = HogwartsProphet::latest()->take(3)->get();

        return view('guest.home', compact('latestArticles'));
    }
}
