<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Mutasi;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Http\Request;
use App\Models\DataJenisAset;
use App\Models\LokasiPenempatan;

class MutasiController extends Controller
{
    public $barang;
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $filter ="all";
        $barang = Barang::where('jenis_asets_id', '!=', 2)->get();
        $jenis = DataJenisAset::all();
        $lokasi = LokasiPenempatan::all();
        return view('mutasi.index', compact('barang', 'jenis', 'filter', 'lokasi'));
    }
    /**
     * getJenis
     *  Mengambil Data Jenis Dari Setiap Request Yang Ada Di  Server
     *  Dan Mengirim Ke client
     * @param  mixed $request
     * @return void
     */
    public function getJenis(Request $request)
    {
        $filter ="all";
        if ($request->filter == 'all') {
            $barang = Barang::where('jenis_asets_id', '!=', 2)->get();
        } else {
            $barang = Barang::where('jenis_asets_id', $request->filter)->get();
        }
        $lokasi = LokasiPenempatan::all();
        $jenis = DataJenisAset::all();
        return view('mutasi.index', compact('barang', 'jenis' ,'filter', 'lokasi'));
    }
    /**
     * create
     *  Membuat Field Tabel Mutasi
     * @param  mixed $request
     * @return void
     */
    public function create(Request $request)
    {
        $barang = Mutasi::max('kode');
        $number = substr($barang,2,3);
        $number++;
        $kode = "M-" . sprintf("%02s", $number);
        $lokasi = LokasiPenempatan::where('id', $request->ke)->first();
        $lokasi_penempatan = 'Lantai'.$lokasi->lantai . '/ Ruangan' . $lokasi->ruangan;
        $mutasi = new Mutasi();
        $mutasi->kode = $kode;
        $mutasi->barang_id = $request->id;
        $mutasi->tgl_mutasi = $request->tgl_mutasi;
        $mutasi->dari = $request->dari;
        $mutasi->ke = $request->ke;
        $mutasi->jumlah_mutasi = $request->jumlah_mutasi;
        $mutasi->ket = $request->ket;
        $mutasi->save();


        return redirect()->back()->with('success', 'Berhasil Di Mutasi');
    }

    public function riwayatMutasi(){
        $barang = Barang::all();
        $mutasi = Mutasi::orderBy('id','desc')->get();
        $jenis = DataJenisAset::all();
        $lokasi = LokasiPenempatan::all();
        return view('mutasi.riwayat', compact('mutasi', 'barang' ,'jenis', 'lokasi'));
    }

    public function edit($id){
        $mutasi = Mutasi::find($id);
        $barang_id = $mutasi->barangs->kode . ',' . $mutasi->barangs->nama_barang;
        $tgl_mutasi = $mutasi->tgl_mutasi;
        $dari = $mutasi->dari;
        $ke = $mutasi->ke;
        $ket = $mutasi->ket;
        $jumlah_mutasi = $mutasi->jumlah_mutasi;
        $jenis = DataJenisAset::all();
        $lokasi = LokasiPenempatan::all();
        return view('mutasi.edit', compact('mutasi','barang_id','tgl_mutasi','dari', 'ke','ket','jenis', 'lokasi', 'jumlah_mutasi'));
    }

    public function update($id, Request $request){
        // dd($request->ke);
        if($request->ke == '' || $request->ke == null){
            $mutasi = Mutasi::where('id',$id)->update([
                'tgl_mutasi'=> $request->tgl_mutasi,
                'dari'=> $request->dari,
                'ket'=> $request->ket,
            ]);
        }else{
            $mutasi = Mutasi::where('id',$id)->update([
                'tgl_mutasi'=> $request->tgl_mutasi,
                'dari'=> $request->dari,
                'ke'=> $request->ke,
                'ket'=> $request->ket,
            ]);
        }
        return redirect()->route('mutasi-riwayat')->with('success', 'berhasil Di Update');
    }
    public function delete($id){
        $mutasi = Mutasi::find($id)->delete();
        return redirect()->route('mutasi-riwayat')->with('success', 'berhasil Di Hapus');
    }
    public function cetakMutasi($start ,$end){
        $startDate = $start;
        $endDate =$end;
        $data = Mutasi::all()
                    ->whereBetween('tgl_mutasi', [$startDate, $endDate]);

        $pdf = PDF::loadview('laporan.cetakmutasi',['data' => $data])->setOptions(['defaultFont' => 'sans-serif'])->setPaper('a4', 'landscape');

         return $pdf->stream('Laporan Data Mutasi.pdf');
    }
    public function laporanMutasi(){
        return view('laporan.mutasi');
    }
    public function filterDateMutasi(Request $request){
        $this->validate($request, [
            'tgl_awal'=> 'date',
            'tgl_akhir'=> 'date',
        ]);
        $startDate = $request->tglawal;
        $endDate = $request->tglakhir;
        $data = Mutasi::all()->whereBetween('tgl_mutasi', [$request->tglawal, $request->tglakhir]);
        // return [$data,$startDate, $endDate];
        return view('laporan.mutasi', compact('data' ,'startDate', 'endDate'));
    }

    public function DetailBarangMutasi($id){
        $barang = Barang::find($id);
        $mutasi = Mutasi::where('barang_id', $id)->get();
        return view('mutasi.detailMutasi', compact('barang', 'mutasi'));
    }
}
