<?php

namespace App\Http\Controllers;

use App\Models\HogwartsProphet;

class HogwartsProphetController extends Controller
{
    /**
     * Tampilkan halaman Hogwarts Prophet untuk publik
     */
    public function index()
    {
        $news = HogwartsProphet::latest()->paginate(6); // ambil berita terbaru
        return view('guest.hogwarts-prophet.index', compact('news'));
    }

    /**
     * Bisa tambahkan show() kalau mau detail artikel
     */
    public function show(HogwartsProphet $hogwartsProphet)
    {
        return view('guest.hogwarts-prophet.show', compact('hogwartsProphet'));
    }
}
