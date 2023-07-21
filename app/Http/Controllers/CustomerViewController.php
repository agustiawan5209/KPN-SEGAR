<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use App\Models\Barang;
use App\Models\Voucher;
use App\Models\JenisBarang;
use Illuminate\Http\Request;

class CustomerViewController extends Controller
{
    public function index()
    {
        $barang = Barang::all();
        $barang_baru = Barang::orderby('id', 'desc')->paginate(6);
        return view('customer.index', [
            'barang' => $barang,
            'barang_baru' => $barang_baru
        ]);
    }
    public function detail($id)
    {
        $barang = Barang::find($id);
        $barang_relate  = Barang::orderBy('id', 'desc')->paginate(8);
        return view('customer.product', [
            'barang' => $barang,
            'relate_barang' => $barang_relate,
        ]);
    }

    public function produk(Request $request)
    {
        $barang = Barang::all();
        if ($request->katalog !== null) {
            $barang = Barang::whereHas('jenis_barangs', function ($query) use ($request) {
                $query->where('jenis_barang', $request->katalog);
            })->get();
        }
        $jenisBarang = JenisBarang::all();
        // dd($jenisBarang);
        return view('customer.produk.allproduk', [
            'barang' => $barang,
            'jenis' => $jenisBarang,
        ]);
    }

    public function DashboardUser()
    {
        return view('staff');
    }

    public function potongan()
    {
        $promo = Promo::all();
        $voucher = Voucher::all();
        return view('customer.potongan.index', [
            'promo' => $promo,
            'voucher' => $voucher
        ]);
    }
}
