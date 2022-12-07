<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Barang;
use App\Models\Pinjam;
use App\Models\Satuan;
use App\Models\Status;
use App\Models\Anggota;
use App\Models\TrxStatus;
use App\Models\Peminjaman;
use App\Models\JenisBarang;
use Illuminate\Http\Request;
use App\Models\DataJenisAset;
use Barryvdh\DomPDF\Facade\PDF;
use App\Models\DetailPeminjaman;
use App\Models\StatusKonfirmasi;
use App\Models\StatusPeminjaman;
use App\Models\DataAsalPerolehan;
use App\Notifications\NotifPinjam;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class PinjamController extends Controller
{
    //MENAMPILKAN DATA MASTER KE FORM //STAFF
    public function index($id)
    {
        $dataasalperolehan = DataAsalPerolehan::all();
        $datajenisaset = DataJenisAset::all();
        $pinjam = Pinjam::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $inputbarang = Barang::all();
        $jenisbarang = JenisBarang::all();
        $inputbarang = Barang::find($id);
        $anggota = Anggota::where('status', '1')->get();
        return view('pinjam.formulir', [
            'title' => ' ',
            'jenisbarang' => $jenisbarang,
            'jenisaset' => $datajenisaset,
            'dataasalperolehan' => $dataasalperolehan,
            'datasatuan' => $datasatuan,
            'inputbarang' => $inputbarang,
            'jenisbarang' => $jenisbarang,
            'pinjam' => $pinjam,
            'anggota' => $anggota,
        ]);
    }

    public function pinjamstaff()
    {
        $dataasalperolehan = DataAsalPerolehan::all();
        $datajenisaset = DataJenisAset::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $inputbarang = Barang::all();
        $akun = User::all();
        if (Auth::user()->roles_id == 3) {
            $pinjam = Pinjam::where('jenis_peminjaman', 'Uang')->get();
        } else {
            $pinjam = Pinjam::whereNull('ket')
                ->where('jenis_peminjaman', '=', 'Barang')
                ->where('kode_anggota', Auth::user()->anggota->kode_anggota)->get();
        }

        $status = Status::all();
        $trxstatus = TrxStatus::all();
        return view('staff.pinjam', [
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

    public function riwayatstaff()
    {
        $dataasalperolehan = DataAsalPerolehan::all();
        $datajenisaset = DataJenisAset::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $inputbarang = Barang::all();
        $akun = User::all();
        if (Auth::user()->roles_id == 3) {
            $pinjam = Pinjam::where('jenis_peminjaman', 'Barang')->get();
        } else {
            $pinjam = Pinjam::where('kode_anggota', Auth::user()->anggota->kode_anggota)->get();
        }
        $status = Status::all();
        $trxstatus = TrxStatus::all();
        // dd($pinjam);
        return view('staff.riwayat', [
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

    public function pengajuan()
    {
        $dataasalperolehan = DataAsalPerolehan::all();
        $datajenisaset = DataJenisAset::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $inputbarang = Barang::all();
        $akun = User::all();
        $pinjam = Pinjam::latest()->get();
        $status = Status::all();
        $trxstatus = TrxStatus::all();
        return view('kepalaunit.pengajuan', [
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

    public function riwayatkepala()
    {
        $dataasalperolehan = DataAsalPerolehan::all();
        $datajenisaset = DataJenisAset::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $inputbarang = Barang::all();
        $akun = User::all();
        $pinjam = Pinjam::latest()->get();
        $status = Status::all();
        $trxstatus = TrxStatus::all();
        return view('kepalaunit.riwayat', [
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

    /**
     * peminjaman
     *  FUngsi Tampilkan View Peminjaman Pada Admin
     *  Akses Admin
     * @return void
     */
    public function peminjaman()
    {
        $dataasalperolehan = DataAsalPerolehan::all();
        $datajenisaset = DataJenisAset::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $inputbarang = Barang::all();
        $akun = User::all();
        $pinjam = Pinjam::whereNull('ket')
            ->where('jenis_peminjaman', '=', 'Barang')
            ->orderBy('id', 'desc')
            ->get();
        $status = Status::all();
        $trxstatus = TrxStatus::all();
        return view('peminjaman.peminjaman', [
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

    public function riwayatadmin()
    {
        $dataasalperolehan = DataAsalPerolehan::all();
        $datajenisaset = DataJenisAset::all();
        $jenisbarang = JenisBarang::all();
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
        return view('peminjaman.riwayatpinjam', [
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

    /**
     * create
     *  Fungsi Membuat Field Tabel Pinjam
     *  Akses Hanya Untuk Admin
     * @param  mixed $request
     * @return void
     */
    public function create(Request $request)
    {
        // dd($request->all());
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

        if ($b->jumlah < $request->jumlah_pinjam) {
            return redirect()
                ->back()
                ->with('warning', 'Maaf jumlah barang yang anda pinjam melebihi dari sisa stok yang ada');
        } else {

            $nama_bukti = $request->bukti_pinjam->getClientOriginalName();

            $request->file('bukti_pinjam')->move('bukti_pinjam/', $nama_bukti);

            $b = Barang::where('id', $request->barangs_id)->first();
            $anggota = Anggota::where('kode_anggota', '=', $request->kode_anggota)->first();

            $pinjam = new Pinjam();
            $pinjam->kode_peminjaman = $book_id;
            $pinjam->barangs_id = $request->barangs_id;
            $pinjam->kode_anggota = $request->kode_anggota;
            $pinjam->nama_peminjam = $anggota->detail->nama_lengkap;
            $pinjam->jenis_peminjaman = "Barang";
            $pinjam->tgl_pengajuan = $request->tgl_pengajuan;
            // $pinjam->tgl_pinjam = $request->tgl_pengajuan;
            $pinjam->bunga = $request->bunga;
            $pinjam->tgl_kembali = $request->tgl_kembali;
            $pinjam->jumlah_pinjam = $request->jumlah_pinjam;

            $pinjam->save();
            $trxstatus = new TrxStatus();
            $trxstatus->kode_peminjaman = $book_id;
            $trxstatus->users_id = $request->input('users_id');
            $trxstatus->pinjams_id = $pinjam->id;
            $trxstatus->status_id = 3;
            $trxstatus->save();
            // User
            $user = User::find($request->input('users_id'));

            // Barang
            $brg = Barang::where('id', $request->barangs_id)->first();
            // dd(intval($brg->jumlah - $request->jumlah_pinjam));
            $brg->update([
                'jumlah' => intval($brg->jumlah - $request->jumlah_pinjam),
            ]);
            Notification::send($pinjam, new NotifPinjam([
                'nama' => $user->name,
                'barang' => $brg->kode . ',' . $brg->nama_barang . ', ',
                'jumlah' => $request->jumlah_pinjam,
            ]));
            return redirect()
                ->back()
                ->with('success', 'Pengajuan Peminjaman Sukses');
        }
    }

    /**
     * insertstatus
     *  Fungsi Mengembalikan Barang Pinjaman
     *  Akses Admin
     * @param  mixed $request
     * @return void
     */
    public function insertstatus(Request $request)
    {
        $pinjam = Pinjam::where('kode_peminjaman', $request->input('kode_peminjaman'))->first();

        if ($request->status_id == 2) {
            $brg = Barang::where('id', $request->barang_id)->first();
            // dd(intval($brg->jumlah - $request->jumlah_pinjam));
            $brg->update([
                'jumlah' => intval($brg->jumlah + $pinjam->jumlah_pinjam),
            ]);
        }
        $trxstatus = new TrxStatus();
        $trxstatus->kode_peminjaman = $request->input('kode_peminjaman');
        $trxstatus->users_id = $request->input('users_id');
        $trxstatus->status_id = $request->input('status_id');
        $trxstatus->ket = $request->input('ket');
        $trxstatus->pinjams_id = $pinjam->id;
        $trxstatus->save();

        return redirect()
            ->back()
            ->with('success', 'Verifikasi status berhasil');
    }

    /**
     * menyetujui
     *  Fungsi Menyetujui Peminjaman Barang
     *  AKses Admin
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function menyetujui(Request $request, $id)
    {
        $pinjams = Pinjam::where('id', $id)->first();
        // dd($id);
        // $pinjam = Pinjam::where('kode_peminjaman', $pinjams->kode_peminjaman)->first();
        // $pinjams = Pinjam::where('id', $pinjam->id)->first();
        $trxstatus = new TrxStatus();
        $trxstatus->kode_peminjaman = $request->input('kode_peminjaman');
        $trxstatus->users_id = $request->input('users_id');
        $trxstatus->status_id = 3;
        $trxstatus->pinjams_id = $pinjams->id;
        $trxstatus->save();

        // $brg = Barang::where('id', $pinjams->barangs_id)->first();
        // $brg->jumlah -= (int) $pinjams->jumlah_pinjam;
        // $brg->save();
        return redirect()
            ->back()
            ->with('success', 'Verifikasi status berhasil');
    }

    /**
     * mengembalikan
     *  Mengupdate Status Pinjaman
     *  Status ID = 4 || 6 -> Dikembalikan
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function mengembalikan(Request $request, $id)
    {
        $pinjams = Pinjam::where('id', $id)->first();
        $pinjams->update([
            'ket' => $request->input('ket'),
        ]);
        $tgl_sekarang = Carbon::now()->format('Y-m-d');
        if ($tgl_sekarang > $pinjams->tgl_kembali) {
            $trxstatus = new TrxStatus();
            $trxstatus->kode_peminjaman = $request->input('kode_peminjaman');
            $trxstatus->users_id = $request->input('users_id');
            $trxstatus->ket = $request->input('ket');
            $trxstatus->status_id = 6;
            $trxstatus->pinjams_id = $pinjams->id;
            $trxstatus->save();
        } else {
            $trxstatus = new TrxStatus();
            $trxstatus->kode_peminjaman = $request->input('kode_peminjaman');
            $trxstatus->users_id = $request->input('users_id');
            $trxstatus->ket = $request->input('ket');
            $trxstatus->status_id = 4;
            $trxstatus->pinjams_id = $pinjams->id;
            $trxstatus->save();
        }
        $brg = Barang::where('id', $pinjams->barangs_id)->first();
        $brg->jumlah += (int) $pinjams->jumlah_pinjam;
        $brg->save();

        return redirect()
            ->back()
            ->with('success', 'Verifikasi status berhasil');
    }

    public function laporanpeminjaman()
    {
        $dataasalperolehan = DataAsalPerolehan::all();
        $datajenisaset = DataJenisAset::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $inputbarang = Barang::all();
        $peminjaman = Pinjam::latest()->get();
        $akun = User::all();
        return view('laporan.peminjaman', [
            'title' => 'riwayat',
            'jenisbarang' => $jenisbarang,
            'jenisaset' => $datajenisaset,
            'dataasalperolehan' => $dataasalperolehan,
            'datasatuan' => $datasatuan,
            'inputbarang' => $inputbarang,
            'peminjaman' => $peminjaman,
            'akun' => $akun,
        ]);
    }

    public function sortirpeminjaman(Request $request)
    {
        $dataasalperolehan = DataAsalPerolehan::all();
        $datajenisaset = DataJenisAset::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $inputbarang = Barang::all();
        // $barangkeluar = Barangkeluar::all();
        $startDate = $request->tglawal;
        $endDate = $request->tglakhir;

        $data = Pinjam::all()->whereBetween('tgl_pengajuan', [$startDate, $endDate]);
        return view('laporan.peminjaman', [
            'title' => 'barangmasuk',
            'jenisbarang' => $jenisbarang,
            'jenisaset' => $datajenisaset,
            'dataasalperolehan' => $dataasalperolehan,
            'datasatuan' => $datasatuan,
            'inputbarang' => $inputbarang,
            'data' => $data,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ]);
    }

    public function cetakLaporanPeminjaman($start, $end)
    {
        $startDate = $start;
        $endDate = $end;
        $data = Pinjam::all()->whereBetween('tgl_pengajuan', [$startDate, $endDate]);

        $pdf = PDF::loadview('laporan.cetakpeminjaman', ['data' => $data])
            ->setOptions(['defaultFont' => 'sans-serif'])
            ->setPaper('a4', 'landscape');

        return $pdf->download('Laporan Data Peminjaman.pdf');
    }
}
