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

class PublikController extends Controller
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
        return view('pages.publik.data-curah-hujan.index', compact('wilayahs', 'data'));
    }

    public function getData(Request $request){
        $wilayah = Wilayah::find($request['wilayahs_id']);
        $tahun = $request['tahun'];
        $bulan = $request['bulan'];
    
        $wilayahs = Wilayah::get();
        $jumlahHari = Carbon::createFromFormat('Y-m-d', $tahun.'-'.$bulan.'-01')->daysInMonth;
        $existingCurahHujans = CurahHujan::where([
            ['wilayahs_id', $wilayah->id],
            ['tahun', $tahun],
            ['bulan', $bulan]
        ])->get()->groupBy('tanggal'); // Group by date for easier checking
    
        // Loop to create entries if they don't exist
        for ($i = 1; $i <= $jumlahHari; $i++) {
            $curahHujanForDate = $existingCurahHujans->get($i);
            if ($curahHujanForDate->isEmpty()) {
                // If there are no entries for the date, create a new one
                CurahHujan::create([
                    'wilayahs_id' => $wilayah->id,
                    'curah_hujan' => 0,
                    'tahun' => $tahun,
                    'bulan' => $bulan,
                    'tanggal' => $i,
                ]);
            } else {
                // If there are multiple entries, keep the one with non-zero rainfall, delete others
                $curahHujanNotEmpty = $curahHujanForDate->filter(function ($curahHujan) {
                    return $curahHujan->curah_hujan != 0;
                });
                if ($curahHujanNotEmpty->isEmpty()) {
                    // If none have non-zero rainfall, keep the first one and delete others
                    $curahHujanForDate->splice(1)->each->delete();
                } else {
                    // If at least one has non-zero rainfall, delete others
                    $curahHujanForDate->reject(function ($curahHujan) use ($curahHujanNotEmpty) {
                        return $curahHujan->id == $curahHujanNotEmpty->first()->id;
                    })->each->delete();
                }
            }
        }
    
        // Retrieve data after creating new entries
        $curahHujans = CurahHujan::where([
            ['wilayahs_id', $wilayah->id],
            ['tahun', $tahun],
            ['bulan', $bulan]
        ])->orderBy('tanggal')->get();
    
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

}
