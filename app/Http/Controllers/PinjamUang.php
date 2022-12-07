<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class PinjamUang extends Controller
{

    public function __construct()
    {
        if (Auth::check()) {
            if (Auth::user()->roles_id == 2 && Auth::user()->anggota == null) {
                abort(403);
            }
        }
    }
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
        return view('pinjamuang.index', [
            'pinjam' => $pinjam,
            'trxstatus' => $trxstatus,
            'status' => Status::all(),
            'akun' => $akun
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
        $user = Anggota::where('status', '1')->get();
        return view('pinjamuang.form', [
            'edit' => false,
            'jenis' => $jenis,
            'user' => $user,
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
        // dd($request->all());
        $valid =  $this->validate($request, [
            'jumlah_pinjam' => ['required', 'numeric'],
            'tgl_pengajuan' => ['required', 'date'],
            'tgl_kembali' => ['required', 'date'],
            'bunga' => ['required', 'numeric'],
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
        $total_bunga = $request->jumlah_pinjam * ($request->bunga / 100) ;

        $nama_bukti = $request->bukti_pinjam->getClientOriginalName();
        $ext_bukti = $request->bukti_pinjam->getClientOriginalExtension();

        $request->file('bukti_pinjam')->move('bukti_pinjam/', $nama_bukti);

        $b = Barang::where('id', $request->barangs_id)->first();
        $anggota = Anggota::where('kode_anggota', '=',$request->kode_anggota)->first();

        $pinjam = new Pinjam();
        $pinjam->kode_peminjaman = $book_id;
        $pinjam->kode_anggota = $request->kode_anggota;
        $pinjam->nama_peminjam = $anggota->detail->nama_lengkap;
        $pinjam->jenis_peminjaman = "Uang";
        $pinjam->bunga = $request->bunga;
        $pinjam->tgl_pengajuan = $request->tgl_pengajuan;
        $pinjam->tgl_kembali = $request->tgl_kembali;
        $pinjam->jumlah_pinjam = $request->jumlah_pinjam;
        $pinjam->bukti_pinjam = $nama_bukti;

        $pinjam->save();
        // User
        $user = User::find($request->input('users_id'));
        $trxstatus = new TrxStatus();
        $trxstatus->kode_peminjaman = $book_id;
        $trxstatus->users_id = $request->input('users_id');
        $trxstatus->pinjams_id = $pinjam->id;
        $trxstatus->status_id = 3;
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

    public function getJenis($id)
    {
        $jenis = JenisBunga::find($id);
        return response()->json($jenis);
    }

    public function KepalaIndex()
    {
        $dataasalperolehan = DataAsalPerolehan::all();
        $datajenisaset = DataJenisAset::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $inputbarang = Barang::all();
        $akun = User::all();
        $pinjam = Pinjam::where('jenis_peminjaman', '=', 'Uang')
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
