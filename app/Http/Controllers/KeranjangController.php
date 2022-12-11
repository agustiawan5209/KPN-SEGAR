<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
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
        $keranjang = Keranjang::create([
            'user_id'=> Auth::user()->id,
            'barang_id'=> $barang_id,
            'harga'=> $barang->harga,
            'jumlah'=> $request->jumlah,
            'total'=> $barang->harga * $request->jumlah,
        ]);
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
        if(Auth::user()->id == $keranjang->user_id){
            $keranjang->update([
                'jumlah'=> $request->jumlah,
            ]);
        }
        return response()->json('Berhasil');
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
        return response()->json('Berhasil');
    }
}
