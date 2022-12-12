<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Keranjang;
use App\Models\Pembelian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class KeranjangController extends Controller
{
    public function kodeTransaksi(){
        $data = Pembelian::max('kode');
        if ($data == null) {
            $kode = '#KP001';
        } else {
            // dd($data);
            $huruf = '#KP';
            $urutan = (int) substr($data, 3, 3);
            $urutan++;
            $kode = $huruf . sprintf('%03s', $urutan);
        }
        return $kode;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keranjang = Keranjang::where('user_id', Auth::user()->id)->get();
        return view('customer.keranjang.index',[
            'keranjang'=> $keranjang,
            'kode'=> $this->kodeTransaksi()

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($barang_id, Request $request)
    {
        $barang = Barang::find($barang_id);
        // dd(Auth::user()->id);
        $keranjang = Keranjang::where('barang_id', '=', $barang_id)->where('user_id', '=', Auth::user()->id)->get();
        if($keranjang->count() < 1){
            $keranjang = Keranjang::create([
                'foto'=> $barang->foto,
                'user_id'=> Auth::user()->id,
                'nama_barang'=> $barang->nama_barang,
                'barang_id'=> $barang_id,
                'harga'=> $barang->harga,
                'jumlah'=> 1,
                'sub_total'=> $barang->harga *1,
            ]);
            Alert::success('Info','Berhasil Di Tambahkan');
        }


        return redirect()->route('keranjang.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Keranjang  $keranjang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $keranjang = Keranjang::find($id);
        $barang = Barang::find($keranjang->barang_id);
        if($barang->jumlah >= $request->jumlah){
            if(Auth::user()->id == $keranjang->user_id){
                $keranjang->update([
                    'jumlah'=> $request->jumlah,
                    'sub_total'=> $request->sub_total,
                ]);
            }
        }
        $sub_total = Keranjang::sum('sub_total');

        return $sub_total;
    }
    public function cekJumlahBarang($id){
        $keranjang = Keranjang::find($id);
        $barang = Barang::find($keranjang->barang_id);
        return $barang->jumlah;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Keranjang  $keranjang
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $keranjang = Keranjang::find($id);
        if(Auth::user()->id == $keranjang->user_id){
            $keranjang->delete();
        }
        return redirect()->back();
    }
}
