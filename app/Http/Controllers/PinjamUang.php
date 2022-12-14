<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Barang;
use App\Models\Pinjam;
use App\Models\Satuan;
use App\Models\Status;
use App\Models\Anggota;
use App\Models\Angsuran;
use App\Models\TrxStatus;
use App\Models\JenisBunga;
use App\Models\JenisBarang;
use Illuminate\Http\Request;
use App\Models\DataJenisAset;
use App\Models\DataAsalPerolehan;
use App\Notifications\NotifPinjam;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\SimpananController;
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
        $this->cekAngsuranKadaluarsa();
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

        $nama_bukti = $request->bukti_pinjam->getClientOriginalName();
        $request->file('bukti_pinjam')->move('bukti_pinjam/', $nama_bukti);
        $anggota = Anggota::where('kode_anggota', '=', $request->kode_anggota)->first();

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
        $pinjam->ket = $request->ket;
        $pinjam->save();
        $batas_angsuran = count($request->tgl_angsuran);
        $tgl_angsuran = $request->tgl_angsuran;
        $bunga =  $request->jumlah_pinjam *(($request->bunga * $batas_angsuran) /100);
        $jumlah_angsuran = $request->jumlah_angsuran + $bunga;
        // $jumlah_bayar = $request->jumlah_pinjam / $batas_angsuran;
        $sisa_bayar = $request->jumlah_pinjam ;
        // dd($request->tgl_angsuran);
        for ($i = 0; $i < $batas_angsuran; $i++) {
            $sisa_bayar -= $jumlah_angsuran[$i];
            // $hasil -= $sisa_bayar[$i] - $jumlah_bayar;
            $arr[$i] = [
                'pinjam_id' => $pinjam->id,
                'kode_angsuran' => $pinjam->kode_peminjaman . "-A-" . $i,
                'tgl_angsuran' => $tgl_angsuran[$i],
                'jumlah_bayar' => $jumlah_angsuran[$i],
                'sisa_bayar' => $sisa_bayar,
                'status' => '0',
                'denda' => '0',
                'jumlah_denda' => '0',

            ];
        }
        Angsuran::insert($arr);
        $sim = new SimpananController();
        $sim->store($request->kode_anggota, $request->tgl_pengajuan,$request->jumlah_pinjam , 0, $request->jumlah_pinjam);
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
        $pinjam = Pinjam::find($id);
        $angsuran = Angsuran::where('pinjam_id', $id)->get();
        $trxstatus = TrxStatus::all();
        $akun = User::all();
        return view('angsuran.detail', [
            'data' => $pinjam,
            'trxstatus' => $trxstatus,
            'status' => Status::all(),
            'akun' => $akun,
            'angsuran' => $angsuran
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Anggota::where('status', '1')->get();
        $pinjam = Pinjam::find($id);
        return view('pinjamuang.edit',[
            'user'=> $user,
            'pinjam'=> $pinjam,
        ]);
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
        $valid =  $this->validate($request, [
            'jumlah_pinjam' => ['required', 'numeric'],
            'tgl_pengajuan' => ['required', 'date'],
            'tgl_kembali' => ['required', 'date'],
            'bunga' => ['required', 'numeric'],
        ]);
        if($request->file('bukti_pinjam') != null){
            $nama_bukti = $request->bukti_pinjam->getClientOriginalName();
            $request->file('bukti_pinjam')->move('bukti_pinjam/', $nama_bukti);
        }else{
            $nama_bukti = Pinjam::find($id)->bukti_pinjam;
        }
        $pinjam = Pinjam::where('id', $id)->update([
            'kode_anggota'=> $request->kode_anggota,
            'jumlah_pinjam'=> $request->jumlah_pinjam,
            'tgl_pengajuan'=> $request->tgl_pengajuan,
            'tgl_kembali'=> $request->tgl_kembali,
            'bunga'=> $request->bunga,
            'bukti_pinjam'=> $nama_bukti,
            'ket'=> $request->ket,
        ]);
        Alert::success("Info", 'Berhasil Di Ganti');
        return redirect()->route('pinjamUang.index');

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

    public function editAngsuran($id)
    {
        $angsuran = Angsuran::find($id);
        return view('angsuran.edit', [
            'angsuran' => $angsuran,
        ]);
    }
    public function UpdateAngsuran(Request $request, $id, $pinjam_id)
    {
        $valid = $this->validate($request, [
            'jumlah_bayar' => ['required', 'numeric'],
            'sisa_bayar' => ['required', 'numeric'],
            'tgl_angsuran' => ['required', 'date'],
            'denda' => ['required', 'numeric'],
            'jumlah_denda' => ['required', 'numeric'],
        ]);
        $angsuran = Angsuran::find($id)->update($valid);
        Alert::success('Berhasil', "Edit Data Angsuran berhasil");
        return redirect()->route('pinjamUang.show', ['id' => $pinjam_id]);
    }
    public function destroyAngsuran($id, $pinjam_id)
    {
        $angsuran = Angsuran::find($id)->delete();
        Alert::error('Berhasil', " Data Angsuran berhasil Di Hapus");
        return redirect()->route('pinjamUang.show', ['id' => $pinjam_id]);
    }

    private function cekAngsuranKadaluarsa()
    {
        $today = Carbon::now()->format("Y-m-d");
        $angsuran = Angsuran::whereDate('tgl_angsuran', $today)->where('status', '=', '0')->get();
        if ($angsuran->count() > 0) {
            foreach ($angsuran as $key => $angsuran) {
                Angsuran::where('id', $angsuran->id)->update([
                    'status' => '1',
                    'denda' => '1'
                ]);
            }
        }
    }
    public function riwayat()
    {
        $datasatuan = Satuan::all();
        $inputbarang = Barang::all();
        $akun = User::all();
        $pinjam = Pinjam::whereNotNull('ket')
            ->where('jenis_peminjaman', '=', 'Barang')
            ->OrWhere('jenis_peminjaman', '=', 'Uang')
            ->orderBy('id', 'desc')
            ->latest()
            ->get();
        $status = Status::all();
        $trxstatus = TrxStatus::all();
        return view('pinjamuang.riwayatpinjam', [
            'title' => 'pengajuan',
            'datasatuan' => $datasatuan,
            'inputbarang' => $inputbarang,
            'status' => $status,
            'pinjam' => $pinjam,
            'akun' => $akun,
            'trxstatus' => $trxstatus,
        ]);
    }
}
