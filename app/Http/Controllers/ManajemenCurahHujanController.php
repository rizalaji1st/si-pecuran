<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    Wilayah,
    CurahHujan
};
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ManajemenCurahHujanController extends Controller
{
    public function index(){
        $data = null;
        if(Session::has('curah_hujan')){
            $curahHujan = CurahHujan::find(Session::get('curah_hujan'));
            $jumlahHari = Carbon::createFromFormat('Y-m-d', $curahHujan->tahun.'-'.$curahHujan->bulan.'-'.$curahHujan->tanggal)->daysInMonth;
            
            $curahHujans = CurahHujan::where([['wilayahs_id', $curahHujan->wilayahs_id],['tahun',$curahHujan->tahun],['bulan',$curahHujan->bulan]])->get();
            
            $data = [
                'jumlah' => $curahHujans->sum('curah_hujan'),
                'hari_hujan' => $curahHujans->where('curah_hujan', '!=', 0)->count(),
                'rata_rata' => $curahHujans->sum('curah_hujan') / $jumlahHari,
                'terbesar' => $curahHujans->max('curah_hujan'),
                'terkecil' => $curahHujans->where('curah_hujan','!=',0)->min('curah_hujan'),
                'hari' => $jumlahHari, 
                'curah_hujans' => $curahHujans
            ];
        }

        $wilayahs = Wilayah::get();
        return view('pages.admin.manajemen-curah-hujan.index', compact('wilayahs', 'data'));
    }

    public function getData(Request $request){
        $wilayah = Wilayah::find($request['wilayahs_id']);
        $tahun = $request['tahun'];
        $bulan = $request['bulan'];

        $wilayahs = Wilayah::get();
        $jumlahHari = Carbon::createFromFormat('Y-m-d', $tahun.'-'.$bulan.'-01')->daysInMonth;
        $curahHujans = CurahHujan::where([['wilayahs_id', $wilayah->id],['tahun',$tahun],['bulan',$bulan]])->get();
        if ($curahHujans->count() < $jumlahHari) {
            for ($i=1; $i <= $jumlahHari ; $i++) { 
                if(!$curahHujans->where([['wilayahs_id', $wilayah->id],['tahun',$tahun],['bulan',$bulan]])->first()){
                    CurahHujan::create([
                        'wilayahs_id' => $wilayah->id,
                        'curah_hujan' => 0,
                        'tahun' => $tahun,
                        'bulan' => $bulan,
                        'tanggal' => $i,
                        'created_by' => Auth::id(),
                    ]);
                }
            }
            $curahHujans = CurahHujan::where([['wilayahs_id', $wilayah->id],['tahun',$tahun],['bulan',$bulan]])->get();
        }

        $response = [
            'jumlah' => $curahHujans->sum('curah_hujan'),
            'hari_hujan' => $curahHujans->where('curah_hujan', '!=', 0)->count(),
            'rata_rata' => $curahHujans->sum('curah_hujan') / $jumlahHari,
            'terbesar' => $curahHujans->max('curah_hujan'),
            'terkecil' => $curahHujans->where('curah_hujan','!=',0)->min('curah_hujan'),
            'hari' => $jumlahHari, 
            'curah_hujans' => $curahHujans
        ];

        return response()->json($response);
    }

    public function update(Request $request){
        $curahHujan = CurahHujan::find($request['id']);
        $curahHujan->curah_hujan = floatval($request['curah_hujan']);
        $curahHujan->save(); 

        alert()->success('Berhasil','Berhasil edit data curah_hujan');
        return redirect('/admin/manajemen-curah-hujan')->with('curah_hujan', $curahHujan->id);
    }
}
