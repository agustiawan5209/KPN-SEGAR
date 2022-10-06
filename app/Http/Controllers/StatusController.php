<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pinjam;
use App\Models\Satuan;
use App\Models\JenisBarang;
use Illuminate\Http\Request;
use App\Models\DataJenisAset;
use App\Models\LokasiPenempatan;
use App\Models\DataAsalPerolehan;

class StatusController extends Controller
{
    public function filter(Request $request){
        $barang = Barang::where('lokasi', '=', $request->filter)->get();
        // dd($barang);
        $dataasalperolehan = DataAsalPerolehan::all();
        $datajenisaset = DataJenisAset::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $inputbarang = Barang::all();
        $pinjam = Pinjam::all();
        $Lokasi = LokasiPenempatan::all();
        $compact = [
            'title' => 'peralatan',
            'jenisbarang' => $jenisbarang,
            'jenisaset' => $datajenisaset,
            'dataasalperolehan' => $dataasalperolehan,
            'datasatuan' => $datasatuan,
            'inputbarang' => $barang,
            'pinjam' => $pinjam,
            'lokasi'=> $Lokasi,
        ];
        // dd($request->data);
        if($request->data == "Perlengkapan"){
            return view('dataperlengkapan.index',$compact);
        }
        if($request->data == "Peralatan"){
            return view('dataperlengkapan.index', $compact);
        }
    }
}
