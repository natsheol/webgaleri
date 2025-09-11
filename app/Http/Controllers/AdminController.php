<?php

namespace App\Http\Controllers;
use App\Models\SchoolProfile;

class AdminController extends Controller
{
    public function index()
    {
        $admin = auth()->guard('admin')->user();
        $school = SchoolProfile::first();

        return view('admin.dashboard', compact('admin'));
    }
}
