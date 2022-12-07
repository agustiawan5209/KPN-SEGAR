<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use App\Models\Barang;
use App\Models\Voucher;
use Illuminate\Http\Request;

class CustomerViewController extends Controller
{
    public function index()
    {
        $barang = Barang::all();
        return view('customer.index', [
            'barang' => $barang,
        ]);
    }
    public function detail($id)
    {
        $barang = Barang::find($id);
        return view('customer.product', [
            'barang' => $barang,
        ]);
    }

    public function produk()
    {
        $barang = Barang::all();
        return view('customer.produk.allproduk', [
            'barang' => $barang,
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
            'promo'=> $promo,
            'voucher'=> $voucher
        ]);
    }
}
