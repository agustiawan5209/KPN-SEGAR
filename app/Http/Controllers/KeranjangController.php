<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pinjam;
use App\Models\Satuan;
use App\Models\JenisBarang;
use Illuminate\Http\Request;
use App\Models\DataJenisAset;
use App\Models\DataAsalPerolehan;
use Illuminate\Support\Facades\Session;

class KeranjangController extends Controller
{
    public function index(Request $request)
    {
        $dataasalperolehan = DataAsalPerolehan::all();
        $datajenisaset = DataJenisAset::all();
        $pinjam = Pinjam::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $inputbarang = Barang::all();
        $jenisbarang = JenisBarang::all();
        // $inputbarang = Barang::find($request->barang_id);
        // $request->session()->forget('keranjang');
        $sessi = $request->session()->get('keranjang.0.0.quantity');

        // if($sessi)
        return $sessi;
        // return view('staff.keranjang', [
        //     'title' => ' ',
        //     'jenisbarang' => $jenisbarang,
        //     'jenisaset' => $datajenisaset,
        //     'dataasalperolehan' => $dataasalperolehan,
        //     'datasatuan' => $datasatuan,
        //     // 'inputbarang' => $inputbarang,
        //     'jenisbarang' => $jenisbarang,
        //     'pinjam' => $pinjam,
        // ]);
    }

    public function isiKeranjang(Request $request)
    {
        $keranjang = [
            'user_id' => $request->user_id,
            'barang_id' => Barang::find($request->barang_id),
            'quantity' => 1,
        ];
        $arr = [$keranjang];
        // $request->session()->push('keranjang', $arr);
        $sessi = $request->session()->get('keranjang');
        // $request->session()->forget('keranjang');
        // dd($sessi);
        if ($request->session()->exists('keranjang')) {
            // JIKA KERANJANG TERISI
            $cek = false;
            for ($i = 0; $i < count($sessi); $i++) {
                // dd([$sessi[$i][0]['barang_id']->id, (int) $request->barang_id]);

                // CEK JIKA KERANJANG SAMA DENGAN BARANG ID
                if ($sessi[$i][0]['barang_id']->id == (int) $request->barang_id) {
                    $cek = true;
                } else {
                    $cek = false;
                }
            }
            // JIKA  NILAI SAMA DENGAN TRUE
            if ($cek == false) {
                $request->session()->push('keranjang', $arr);
                return redirect()
                    ->route('keranjang-index')
                    ->with('success', 'Berhasil Di Masukan Ke Keranjang');
            } else {
                // JIKA NILAI SAMA DENGAN FALSE
                return redirect()
                    ->route('keranjang-index')
                    ->with('warning', 'Keranjang Sudah Terisi');
            }
        } else {
            // JIKA KERANJANG KOSONG
            $request->session()->push('keranjang', $arr);
            return redirect()
                ->route('keranjang-index')
                ->with('success', 'Berhasil Di Masukan Ke Keranjang');
        }
    }

    public function updateCart($id, Request $request)
    {
        $sessi = $request->session()->get('keranjang.0.0.barang_id');
        $sessi = $request->session()->get('keranjang');
        for ($i = 0; $i < count($sessi); $i++) {
            // dd([$sessi[$i][0]['barang_id']->id, (int) $request->barang_id]);

            // CEK JIKA KERANJANG SAMA DENGAN BARANG ID
        }
        return $sessi;
    }
}
