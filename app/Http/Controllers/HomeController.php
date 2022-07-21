<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    Wilayah,
    CurahHujan,
    User,
};

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = [
            'wilayah' => Wilayah::count(),
            'curah_hujan' => CurahHujan::where('curah_hujan','!=',0)->count(),
            'user' => User::count(),
        ];
        return view('welcome', compact('data'));
    }
}
