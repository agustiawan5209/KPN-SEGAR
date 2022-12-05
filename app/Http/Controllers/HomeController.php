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

    public function index()
    {
        $role = Auth::user()->roles_id;
        if ($role == '1') {
            return view('admin');
        }
        if ($role == '3') {
            return view('kepalaunit');
        }
        if ($role == '4') {
            return view('kepalaunit');
        }

        if ($role == '2') {
            return view('staff');
        }else {
            return view('dashboard');
        }
    }

 //function dashhboard
    private function multiSearch(array $array, array $pairs)
    {
        $found = array();
        foreach ($array as $aKey => $aVal) {
            $coincidences = 0;
            foreach ($pairs as $pKey => $pVal) {
                if (array_key_exists($pKey, $aVal) && $aVal[$pKey] == $pVal) {
                    $coincidences++;
                }
            }
            if ($coincidences == count($pairs)) {
                $found[$aKey] = $aVal;
            }
        }

        return $found;
    }

    private function searchByValue($id, $array)
    {
        foreach ($array as $key => $val) {
            if ($val['barangs_id'] === $id) {
                return $key;
            }
        }
        return null;
    }

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
        // foreach ($data as $d) {
        //     foreach (Barang::where('id', $d->barangs_id)->get() as $barang) {
        //         echo $barang->kode . '</br>' . $d->jumlah . '</br>';
        //     }
        // }
        // dd($data);


        //         select SUM(jumlah_pinjam)
        //     from pinjams
        //     group by barangs_id
        //    ORDER BY jumlah_pinjam ASC
        //    LIMIT 1;
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
        if ($role == '4') {



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
        if ($role == '2') {



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
        if ($role == '3') {
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



 // function filter tahun
    // private function multiSearch(array $array, array $pairs)
    // {
    //     $found = array();
    //     foreach ($array as $aKey => $aVal) {
    //         $coincidences = 0;
    //         foreach ($pairs as $pKey => $pVal) {
    //             if (array_key_exists($pKey, $aVal) && $aVal[$pKey] == $pVal) {
    //                 $coincidences++;
    //             }
    //         }
    //         if ($coincidences == count($pairs)) {
    //             $found[$aKey] = $aVal;
    //         }
    //     }

    //     return $found;
    // }

    // private function searchByValue($id, $array)
    // {
    //     foreach ($array as $key => $val) {
    //         if ($val['barangs_id'] === $id) {
    //             return $key;
    //         }
    //     }
    //     return null;
    // }

    public function rekap_tahun(Request $request, $tahun)
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
        // $data = DB::select("SELECT pinjams.barangs_id, sum(pinjams.jumlah_pinjam) as jumlah FROM pinjams INNER JOIN barangs ON (pinjams.barangs_id = barangs.id) GROUP BY pinjams.barangs_id");
        // foreach ($data as $d) {
        //     foreach (Barang::where('id', $d->barangs_id)->get() as $barang) {
        //         echo $barang->kode . '</br>' . $d->jumlah . '</br>';
        //     }
        // }


        //         select SUM(jumlah_pinjam)
        //     from pinjams
        //     group by barangs_id
        //    ORDER BY jumlah_pinjam ASC
        //    LIMIT 1;

        $dataasalperolehan = DataAsalPerolehan::all();
        $thn = Tahun::all();
        $datajenisaset = DataJenisAset::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $inputbarang = Barang::all();
        $detailpeminjaman = DetailPeminjaman::all();
        $pinjam = Pinjam::all();
        $role = Auth::user()->roles_id;

        // return $inputbarang;
        if ($role == '2') {



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
                'kepalaunit',
                compact(
                    'data',
                    'datap',
                    'jenisbarang',
                    // 'jenisaset',
                    'dataasalperolehan',
                    'datasatuan',
                    'inputbarang',
                    'pinjam',


                    'ambilbarang_jan',
                    'ambilbarang_feb',
                    'ambilbarang_mar',
                    'ambilbarang_apr',
                    'ambilbarang_mei',
                    'ambilbarang_jun',
                    'ambilbarang_juli',
                    'ambilbarang_agus',
                    'ambilbarang_sept',
                    'ambilbarang_okto',
                    'ambilbarang_nove',
                    'ambilbarang_dese',

                    'dikembalikan_jan',
                    'dikembalikan_feb',
                    'dikembalikan_mar',
                    'dikembalikan_apr',
                    'dikembalikan_mei',
                    'dikembalikan_jun',
                    'dikembalikan_juli',
                    'dikembalikan_agus',
                    'dikembalikan_sept',
                    'dikembalikan_okto',
                    'dikembalikan_nove',
                    'dikembalikan_dese',

                    'terlambat_jan',
                    'terlambat_feb',
                    'terlambat_mar',
                    'terlambat_apr',
                    'terlambat_mei',
                    'terlambat_jun',
                    'terlambat_juli',
                    'terlambat_agus',
                    'terlambat_sept',
                    'terlambat_okto',
                    'terlambat_nove',
                    'terlambat_dese',

                    'bergerak_jan',
                    'bergerak_feb',
                    'bergerak_mar',
                    'bergerak_apr',
                    'bergerak_mei',
                    'bergerak_jun',
                    'bergerak_juli',
                    'bergerak_agus',
                    'bergerak_sept',
                    'bergerak_okto',
                    'bergerak_nove',
                    'bergerak_dese',

                    'tdkbergerak_jan',
                    'tdkbergerak_feb',
                    'tdkbergerak_mar',
                    'tdkbergerak_apr',
                    'tdkbergerak_mei',
                    'tdkbergerak_jun',
                    'tdkbergerak_juli',
                    'tdkbergerak_agus',
                    'tdkbergerak_sept',
                    'tdkbergerak_okto',
                    'tdkbergerak_nove',
                    'tdkbergerak_dese',

                    'peralatan_jan',
                    'peralatan_feb',
                    'peralatan_mar',
                    'peralatan_apr',
                    'peralatan_mei',
                    'peralatan_jun',
                    'peralatan_juli',
                    'peralatan_agus',
                    'peralatan_sept',
                    'peralatan_okto',
                    'peralatan_nove',
                    'peralatan_dese',

                    'perlengkapan_jan',
                    'perlengkapan_feb',
                    'perlengkapan_mar',
                    'perlengkapan_apr',
                    'perlengkapan_mei',
                    'perlengkapan_jun',
                    'perlengkapan_juli',
                    'perlengkapan_agus',
                    'perlengkapan_sept',
                    'perlengkapan_okto',
                    'perlengkapan_nove',
                    'perlengkapan_dese',
                    'tahun',
                    'thn',
                )
            );
        }
        //role admin
        if ($role == '1') {


            $jumlah = Barang::count();
            // $thn = Tahun::all();
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
                    // 'data',
                    'datap',
                    // 'barang',
                    'jenisbarang',
                    // 'jenisaset',
                    'dataasalperolehan',
                    'datasatuan',
                    'inputbarang',
                    'pinjam',


                    'total_jan',
                    'total_feb',
                    'total_mar',
                    'total_apr',
                    'total_mei',
                    'total_jun',
                    'total_juli',
                    'total_agus',
                    'total_sept',
                    'total_okto',
                    'total_nove',
                    'total_dese',

                    'ditolak_jan',
                    'ditolak_feb',
                    'ditolak_mar',
                    'ditolak_apr',
                    'ditolak_mei',
                    'ditolak_jun',
                    'ditolak_juli',
                    'ditolak_agus',
                    'ditolak_sept',
                    'ditolak_okto',
                    'ditolak_nove',
                    'ditolak_dese',

                    'ambilbarang_jan',
                    'ambilbarang_feb',
                    'ambilbarang_mar',
                    'ambilbarang_apr',
                    'ambilbarang_mei',
                    'ambilbarang_jun',
                    'ambilbarang_juli',
                    'ambilbarang_agus',
                    'ambilbarang_sept',
                    'ambilbarang_okto',
                    'ambilbarang_nove',
                    'ambilbarang_dese',

                    'dikembalikan_jan',
                    'dikembalikan_feb',
                    'dikembalikan_mar',
                    'dikembalikan_apr',
                    'dikembalikan_mei',
                    'dikembalikan_jun',
                    'dikembalikan_juli',
                    'dikembalikan_agus',
                    'dikembalikan_sept',
                    'dikembalikan_okto',
                    'dikembalikan_nove',
                    'dikembalikan_dese',

                    'terlambat_jan',
                    'terlambat_feb',
                    'terlambat_mar',
                    'terlambat_apr',
                    'terlambat_mei',
                    'terlambat_jun',
                    'terlambat_juli',
                    'terlambat_agus',
                    'terlambat_sept',
                    'terlambat_okto',
                    'terlambat_nove',
                    'terlambat_dese',

                    'bergerak_jan',
                    'bergerak_feb',
                    'bergerak_mar',
                    'bergerak_apr',
                    'bergerak_mei',
                    'bergerak_jun',
                    'bergerak_juli',
                    'bergerak_agus',
                    'bergerak_sept',
                    'bergerak_okto',
                    'bergerak_nove',
                    'bergerak_dese',

                    'tdkbergerak_jan',
                    'tdkbergerak_feb',
                    'tdkbergerak_mar',
                    'tdkbergerak_apr',
                    'tdkbergerak_mei',
                    'tdkbergerak_jun',
                    'tdkbergerak_juli',
                    'tdkbergerak_agus',
                    'tdkbergerak_sept',
                    'tdkbergerak_okto',
                    'tdkbergerak_nove',
                    'tdkbergerak_dese',

                    'peralatan_jan',
                    'peralatan_feb',
                    'peralatan_mar',
                    'peralatan_apr',
                    'peralatan_mei',
                    'peralatan_jun',
                    'peralatan_juli',
                    'peralatan_agus',
                    'peralatan_sept',
                    'peralatan_okto',
                    'peralatan_nove',
                    'peralatan_dese',

                    'perlengkapan_jan',
                    'perlengkapan_feb',
                    'perlengkapan_mar',
                    'perlengkapan_apr',
                    'perlengkapan_mei',
                    'perlengkapan_jun',
                    'perlengkapan_juli',
                    'perlengkapan_agus',
                    'perlengkapan_sept',
                    'perlengkapan_okto',
                    'perlengkapan_nove',
                    'perlengkapan_dese',

                    'tahun',
                    'thn',
                )
            );
        }

        //role staff
        if ($role == '3') {
            return view('staff', [
                "title" => "perlengkapan",
                "jenisbarang" => $jenisbarang,
                "jenisaset" => $datajenisaset,
                "dataasalperolehan" => $dataasalperolehan,
                "datasatuan" => $datasatuan,
                "inputbarang" => $inputbarang
            ]);
        } else {
            return view('dashboard', [
                "title" => "perlengkapan",
                "jenisbarang" => $jenisbarang,
                "jenisaset" => $datajenisaset,
                "dataasalperolehan" => $dataasalperolehan,
                "datasatuan" => $datasatuan,
                "inputbarang" => $inputbarang
            ]);
        }
    }
}
