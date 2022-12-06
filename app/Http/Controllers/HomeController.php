<?php

namespace App\Http\Controllers;

use index;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\JenisBarang;
use App\Models\Barang;
use App\Models\DataJenisAset;
use App\Models\DataAsalPerolehan;
use App\Models\Peminjaman;
use App\Models\Satuan;
use App\Models\DetailPeminjaman;
use App\Models\Pinjam;
use App\Models\Tahun;
use App\Models\TrxStatus;
use Carbon\Carbon;


class HomeController extends Controller
{



    public function maindashboard()
    {

        $tt = 0;
        $barang = 0;
        $d = 0;
        $data = DB::select("SELECT pinjams.barangs_id, sum(pinjams.jumlah_pinjam) as jumlah FROM pinjams INNER JOIN barangs ON (pinjams.barangs_id = barangs.id) GROUP BY pinjams.barangs_id");
        $datas = DB::table('pinjams')->select('pinjams.barangs_id', 'barangs.kode', 'barangs.spesifikasi', 'pinjams.jumlah_pinjam')
        ->join('barangs', 'barangs.id', '=', 'pinjams.barangs_id')
        ->get()
            ->toArray();

        // // dd($datas);
        $datap = array();
        $i = 0;

        foreach ($datas as $row_product) {
            if (count($datap) == 0) {
                # code...
                $datap[$i]["barangs_id"] = $row_product->barangs_id;
                $datap[$i]["kode"] = $row_product->kode;
                $datap[$i]["spesifikasi"] = $row_product->spesifikasi;
                // $datap[$i]["jenis_asets_id"] = $row_product->jenis_asets_id;
                $datap[$i]["jumlah"] = (int)$row_product->jumlah_pinjam;
                $i++;
            } else {
                $dump = $this->multiSearch($datap, array('barangs_id' => $row_product->barangs_id));
                if (count($dump) == 0) {
                    # code...
                    $datap[$i]["barangs_id"] = $row_product->barangs_id;
                    $datap[$i]["kode"] = $row_product->kode;
                    $datap[$i]["spesifikasi"] = $row_product->spesifikasi;
                    // $datap[$i]["jenis_asets_id"] = $row_product->jenis_asets_id;
                    $datap[$i]["jumlah"] = (int)$row_product->jumlah_pinjam;
                    $i++;
                } else {
                    $key = $this->searchByValue($row_product->barangs_id, $datap);
                    $datap[$key]["jumlah"] = $datap[$key]["jumlah"] + (int)$row_product->jumlah_pinjam;
                }
            }
        }

        $thn = Tahun::all();
        $dataasalperolehan = DataAsalPerolehan::all();
        $datajenisaset = DataJenisAset::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $inputbarang = Barang::all();
        $detailpeminjaman = DetailPeminjaman::all();
        $pinjam = Pinjam::all();
        $role = Auth::user()->roles_id;

        // return $inputbarang;

        if ($role == '3') {



            $jumlah = Barang::count();

            $asetbergerak = Barang::where('jenis_asets_id', 1)->count();
            $asettidakbergerak = Barang::where('jenis_asets_id', 2)->count();
            $asetperlengkapan = Barang::where('jenis_asets_id', 4)->count();
            $asetperalatan = Barang::where('jenis_asets_id', 3)->count();
            $pengajuan = DetailPeminjaman::where('status_konfirmasis_id', 1)->count();
            $disetujui = DetailPeminjaman::where('status_konfirmasis_id', 2 && 'status_peminjamans_id', 2)->count();
            $dikembalikan = DetailPeminjaman::where('status_konfirmasis_id', 2 && 'status_peminjamans_id', 3)->count();
            $ditolak = DetailPeminjaman::where('status_konfirmasis_id', 3)->count();
            $dibatalkan = DetailPeminjaman::where('status_konfirmasis_id', 5)->count();
            $pinjam = Pinjam::count();

            return view('kepalaunit',compact(
                    'asetbergerak','asettidakbergerak','asetperlengkapan','asetperalatan', 'pinjam','jumlah',
                    'data',
                    'datap',
                    // 'data',
                    'datas',
                    'jenisbarang',
                    // 'jenisaset',
                    'dataasalperolehan',
                    'datasatuan',
                    'inputbarang',
                    'pinjam',


                )
            );
        }
        //role admin
        if ($role == '1') {

            $jumlah = Barang::count();
            $asetbergerak = Barang::where('jenis_asets_id', 1)->count();
            $asettidakbergerak = Barang::where('jenis_asets_id', 2)->count();
            $asetperlengkapan = Barang::where('jenis_asets_id', 4)->count();
            $asetperalatan = Barang::where('jenis_asets_id', 3)->count();
            $pengajuan = DetailPeminjaman::where('status_konfirmasis_id', 1)->count();
            $disetujui = DetailPeminjaman::where('status_konfirmasis_id', 2 && 'status_peminjamans_id', 2)->count();
            $dikembalikan = DetailPeminjaman::where('status_konfirmasis_id', 2 && 'status_peminjamans_id', 3)->count();
            $ditolak = DetailPeminjaman::where('status_konfirmasis_id', 3)->count();
            $dibatalkan = DetailPeminjaman::where('status_konfirmasis_id', 5)->count();
            $pinjam = Pinjam::count();

            return view(
                'admin',
                compact(
                    'asetbergerak','asetperlengkapan','asettidakbergerak','asetperalatan',
                    'datap',
                    // 'barang',
                    'data',
                    'datas',
                    'jenisbarang',
                    // 'jenisaset',
                ),[
                    'trxstatus' => TrxStatus::orderBy('id', 'asc')->get(),
                    'pinjam_barang'=> Pinjam::orderBy('id','desc')->get(),
                ]
            );
        }

        //role staff
        if ($role == '2') {
            return redirect()->route('Customer.Index');

        } else {
            return view('dashboard', [
                "title" => "perlengkapan",
                "jenisbarang" => $jenisbarang,
                "jenisaset" => $datajenisaset,
                "dataasalperolehan" => $dataasalperolehan,
                "datasatuan" => $datasatuan,
                "inputbarang" => $inputbarang,
            ]);
        }
    }


}
