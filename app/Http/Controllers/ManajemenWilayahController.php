<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    Wilayah
};
use RealRashid\SweetAlert\Facades\Alert;

class ManajemenWilayahController extends Controller
{
    public function index(){
        $wilayahs = Wilayah::get();
        return view('pages.admin.manajemen-wilayah.index', compact('wilayahs'));
    }

    public function store(Request $request){
        Wilayah::create([
            'kode' => $request['kode'],
            'name' => $request['name']
        ]);

        alert()->success('Berhasil','Berhasil menambah data wilayah');
        return redirect('/admin/manajemen-wilayah');
    }

    public function update(Request $request){
        $wilayah = Wilayah::find($request['id']);
        $wilayah->kode = $request['kode'];
        $wilayah->name = $request['name'];
        $wilayah->save();

        alert()->success('Berhasil','Berhasil edit data wilayah');
        return redirect('/admin/manajemen-wilayah');
    }

    public function destroy(Wilayah $wilayah){
        $wilayah->delete();

        alert()->success('Berhasil','Berhasil menghapus data wilayah');
        return redirect('/admin/manajemen-wilayah');
    }
}
