<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManajemenCurahHujanController extends Controller
{
    public function index(){
        return view('pages.admin.manajemen-curah-hujan.index');
    }
}
