<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Promo;
use App\Models\Barang;
use App\Models\Pinjam;
use App\Models\Satuan;
use App\Models\Status;
use App\Models\Keranjang;
use App\Models\Pembelian;
use App\Models\PromoUser;
use App\Models\TrxStatus;
use App\Models\JenisBarang;
use Illuminate\Http\Request;
use App\Models\DataJenisAset;
use App\Models\DetailPembelian;
use App\Models\DataAsalPerolehan;
use App\Models\StatusPembelian;
use App\Models\Voucher;
use App\Models\VoucherUser;
use App\Notifications\NotifPinjam;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use RealRashid\SweetAlert\Facades\Alert;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataasalperolehan = DataAsalPerolehan::all();
        $datajenisaset = DataJenisAset::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $inputbarang = Barang::all();
        $akun = User::all();
        if(Auth::user()->roles_id == 2){
            $pinjam = Pembelian::where('user_id', Auth::user()->id)->orderBy('status', 'asc')->get();
        }else{
            $pinjam = Pembelian::orderBy('status', 'asc')->get();
        }
        $status = Status::all();
        $trxstatus = TrxStatus::all();
        return view('pembelian.index', [
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dataasalperolehan = DataAsalPerolehan::all();
        $datajenisaset = DataJenisAset::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $inputbarang = Barang::all();
        $akun = User::all();
        $pinjam = Pinjam::whereNull('ket')
            ->whereNotNull('barangs_id')
            ->where('jenis_peminjaman', '=', 'Beli')
            ->where('users_id', Auth::user()->id)->get();
        $status = Status::all();
        $trxstatus = TrxStatus::all();
        return view('pembelian.form', [
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

    public function kodeTransaksi()
    {
        $data = Pembelian::max('kode');
        if ($data == null) {
            $kode = '#KP001';
        } else {
            // dd($data);
            $huruf = '#KP';
            $urutan = (int) substr($data, 3,3);
            $urutan++;
            $kode = $huruf . sprintf('%03s', $urutan);
        }
        return $kode;
    }

    /**
     * CekPromo
     * Pengecakan Jika user memiliki promo
     * @param  mixed $harga
     */
    public function CekPromo($harga = 0)
    {
        $potongan = array(0);
        $user_id = Auth::user()->id;
        $promo_user = PromoUser::where(['user_id' => $user_id, 'status' => '1'])->get();
        if ($promo_user->count() > 0) {
            foreach ($promo_user as $item) {
                $promo = Promo::find($item->promo_id);
                if ($promo->jenis_promo == 1) {
                    $potongan[] = $promo->potongan;
                } else if ($promo->jenis_promo == 2) {
                    $potongan[] = ($promo->potongan / 100) * $harga;
                }
                PromoUser::find($item->id)->update(['status' => '2']);
            }
        }
        return array_sum($potongan);
    }
    /**
     * CekVoucher
     * Cek Voucher User Jika Ada
     * @param  mixed $harga
     */
    public function CekVoucher($harga)
    {
        $user_id = Auth::user()->id;
        $voucher_user = VoucherUser::where(['user_id' => $user_id, 'status' => '1'])->get();
        $potongan = array(0);
        if ($voucher_user->count() > 0) {
            foreach ($voucher_user as $item) {
                $voucher = Voucher::find($item->voucher_id);
                $potongan[] = ($voucher->potongan / 100) * $harga;
                VoucherUser::find($item->id)->update(['status' => '2']);
            }
        }
        return array_sum($potongan);
    }
    public function diskon($barang_id, $harga)
    {
        $diskon = 0;
        $potongan = 0;
        $barang = Barang::find($barang_id);
       if($barang->diskon !== null){
        $diskon = $barang->diskon->diskon / 100;
        $potongan = $harga * $diskon;
       }

        return $potongan;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,  [
            'nama' => ['required', 'string'],
            'alamat' => ['required', 'string'],
            'no_hp' => ['required', 'numeric', 'min:12'],
            'email' => ['required', 'email'],
            'bukti' => ['required', 'image', 'mimes:jpg,png,svg,bmp'],
            'tgl_transaksi' => ['required', 'date'],
        ]);
        $kode = $this->kodeTransaksi();

        $file = $request->bukti->getClientOriginalName();
        $request->bukti->move('bukti_pembelian/', $file);
        $nama_bukti = $file;
        $promo = $this->CekPromo($request->sub_total);
        $voucher = $this->CekVoucher($request->sub_total);
        $potongan =   $promo + $voucher;

        $sub_total = abs($request->sub_total - $potongan);
        $pembelian = Pembelian::create([
            'kode' => $kode,
            'user_id' => Auth::user()->id,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'bank' => "Mandiri",
            'tgl_transaksi' => $request->tgl_transaksi,
            'bukti' => $nama_bukti,
            'potongan' => $potongan,
            'status'=> '0',
            'sub_total' => $sub_total,
        ]);
        $keranjang = $request->keranjang;
        $jumlah = $request->jumlah;
        for ($i = 0; $i < count($keranjang); $i++) {
            $barang_keranjang = Keranjang::find($keranjang[$i]);
            $barang = Barang::find($barang_keranjang->barang->id);
            $potongan = $this->diskon($barang->id, $barang->harga);

            $total = ($jumlah[$i] * $barang->harga) - $potongan;
            DetailPembelian::create([
                'pembelian_id' => $pembelian->id,
                'nama_barang' => $barang->nama_barang,
                'harga' => $barang->harga,
                'jumlah' => $jumlah[$i],
                'potongan' => $potongan,
                'total' => $total,
            ]);
            Keranjang::find($keranjang[$i])->delete();
        }
        return redirect()->route('Pembelian.success');
    }

    public function success()
    {
        return view('customer.keranjang.success');
    }
    public function konfirmasiPembelian($id, Request $request){
        $pembelian = Pembelian::find($id);
        $status = StatusPembelian::create([
            'pembelian_id'=> $pembelian->id,
            'status'=> $request->status,
            'ket'=> $request->ket,
        ]);
        $pembelian->update(['status'=> '1']);
        Alert::success('Berhasil Di Konfirmasi');
        return redirect()->back();
    }
    public function StatusPembelian($id, Request $request){
        $pembelian = Pembelian::find($id);
        $status = StatusPembelian::create([
            'pembelian_id'=> $pembelian->id,
            'status'=> $request->status,
            'ket'=> $request->ket,
        ]);
        Alert::success('Berhasil Di Update');

        return redirect()->back();

    }
    public function tolakPembelian($id, Request $request){
        $pembelian = Pembelian::find($id);
        $status = StatusPembelian::create([
            'pembelian_id'=> $pembelian->id,
            'status'=> $request->status,
            'ket'=> $request->ket,
        ]);
        $pembelian->update(['status'=> '2']);
        Alert::error('Pembelian Di Tolak');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dataasalperolehan = DataAsalPerolehan::all();
        $datajenisaset = DataJenisAset::all();
        $pinjam = Pinjam::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $inputbarang = Barang::all();
        $jenisbarang = JenisBarang::all();
        $inputbarang = Barang::find($id);
        $pembelian = Pembelian::find($id);
        return view('pembelian.edit', [
            'title' => ' ',
            'jenisbarang' => $jenisbarang,
            'jenisaset' => $datajenisaset,
            'dataasalperolehan' => $dataasalperolehan,
            'datasatuan' => $datasatuan,
            'inputbarang' => $inputbarang,
            'jenisbarang' => $jenisbarang,
            'pinjam' => $pinjam,
            'pembelian'=> $pembelian,
        ]);
    }
    public function detail($id)
    {
        $pembelian = Pembelian::find($id);
        return view('pembelian.edit', [
            'pembelian'=> $pembelian,
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

    public function riwayat()
    {
        $dataasalperolehan = DataAsalPerolehan::all();
        $datajenisaset = DataJenisAset::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $inputbarang = Barang::all();
        $akun = User::all();
        $pinjam = Pinjam::whereNotNull('ket')
            ->where('jenis_peminjaman', '=', 'Barang')
            ->orderBy('id', 'desc')
            ->latest()
            ->get();
        $status = Status::all();
        $trxstatus = TrxStatus::all();
        return view('pembelian.riwayatpinjam', [
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
    public function cekdata()
    {
        $dataasalperolehan = DataAsalPerolehan::all();
        $datajenisaset = DataJenisAset::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $inputbarang = Barang::all();
        abort_if(Auth::user()->roles->id == 1, 401);
        return view('pembelian.cekdata', [
            'title' => 'peralatan',
            'jenisbarang' => $jenisbarang,
            'jenisaset' => $datajenisaset,
            'dataasalperolehan' => $dataasalperolehan,
            'datasatuan' => $datasatuan,
            'inputbarang' => $inputbarang,
        ]);
    }

    public function dataPembelian()
    {
        $dataasalperolehan = DataAsalPerolehan::all();
        $datajenisaset = DataJenisAset::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $inputbarang = Barang::all();
        $akun = User::all();
        $pinjam = Pinjam::whereNotNull('ket')
            ->where('jenis_peminjaman', '=', 'Beli')
            ->get();
        $status = Status::all();
        $trxstatus = TrxStatus::all();
        return view('pembelian.data_pembelian', [
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
