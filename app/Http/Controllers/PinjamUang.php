<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Barang;
use App\Models\Pinjam;
use App\Models\Satuan;
use App\Models\Status;
use App\Models\TrxStatus;
use App\Models\JenisBunga;
use App\Models\JenisBarang;
use Illuminate\Http\Request;
use App\Models\DataJenisAset;
use App\Models\DataAsalPerolehan;
use App\Notifications\NotifPinjam;
use Illuminate\Support\Facades\Notification;

class PinjamUang extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pinjam = Pinjam::where('jenis_peminjaman', '=', 'uang')->get();
        $trxstatus = TrxStatus::all();
        $akun = User::all();
        return view('pinjamuang.index',[
            'pinjam'=> $pinjam,
            'trxstatus'=> $trxstatus,
            'status'=> Status::all(),
            'akun'=> $akun
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jenis = JenisBunga::all();
        return view('pinjamuang.form', [
            'edit' => false,
            'jenis' => $jenis,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $valid =  $this->validate($request, [
            'jumlah_pinjam'=> ['required', 'numeric'],
            'jenis_id'=> ['required', 'numeric'],
            'tgl_pengajuan'=> ['required', 'date'],
            'tgl_kembali'=> ['required', 'date'],
            'total_bunga'=> ['required', 'numeric'],
        ]);
        $book_id = 0;
        $data = Pinjam::max('kode_peminjaman');
        if ($data == null) {
            $book_id = 'PB-001';
        }
        // dd($data);
        $huruf = 'PB';
        $urutan = (int) substr($data, 3, 3);
        $urutan++;
        if ($urutan < 10) {
            $book_id = $huruf . '-00' . $urutan;
        } else {
            $book_id = $huruf . '-' . $urutan;
        }
        $b = Barang::where('id', $request->barangs_id)->first();
        $pinjam = new Pinjam();
        $pinjam->kode_peminjaman = $book_id;
        $pinjam->users_id = $request->users_id;
        $pinjam->nama_peminjam = $request->nama_peminjam;
        $pinjam->jenis_peminjaman = "Uang";
        $pinjam->bunga = $request->total_bunga;
        $pinjam->tujuan = $request->tujuan;
        $pinjam->tgl_pengajuan = $request->tgl_pengajuan;
        // $pinjam->tgl_pinjam = $request->tgl_pengajuan;
        $pinjam->tgl_kembali = $request->tgl_kembali;
        $pinjam->jumlah_pinjam = $request->jumlah_pinjam;

        $pinjam->save();
        // User
        $user = User::find($request->input('users_id'));
        $trxstatus = new TrxStatus();
        $trxstatus->kode_peminjaman = $book_id;
        $trxstatus->users_id = $request->input('users_id');
        $trxstatus->pinjams_id = $pinjam->id;
        $trxstatus->status_id = 5;
        $trxstatus->save();
        Notification::send($pinjam, new NotifPinjam([
            'nama' => $user->name,
            'barang' => "Uang",
            'jumlah' => $request->jumlah_pinjam,
        ]));
        return redirect()
            ->route('pinjamUang.index')
            ->with('success', 'Pengajuan Peminjaman Sukses');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('pinjamuang.form');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getJenis($id){
        $jenis = JenisBunga::find($id);
        return response()->json($jenis);
    }

    public function KepalaIndex(){
        $dataasalperolehan = DataAsalPerolehan::all();
        $datajenisaset = DataJenisAset::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $inputbarang = Barang::all();
        $akun = User::all();
        $pinjam = Pinjam::whereNull('ket')
        ->where('jenis_peminjaman', '=', 'Uang')
        ->get();
        $status = Status::all();
        $trxstatus = TrxStatus::all();
        return view('pinjamuang.admin-index', [
            'title' => 'pengajuan',
            'jenisbarang' => $jenisbarang,
            'jenisaset' => $datajenisaset,
            'dataasalperolehan' => $dataasalperolehan,
            'datasatuan' => $datasatuan,
            'inputbarang' => $inputbarang,
            'status' => $status,
            'pinjam' => $pinjam,
            'akun' => $akun,
            'trxstatus' => $trxstatus,
        ]);
    }
}
