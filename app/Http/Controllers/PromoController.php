<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use App\Http\Requests\StorePromoRequest;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\UpdatePromoRequest;

class PromoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('potongan.promo.index', [
            'promo'=> Promo::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('potongan.promo.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePromoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePromoRequest $request)
    {
        Promo::create([
            'kode'=> $request->kode,
            'jenis_promo'=> $request->jenis_promo,
            'potongan'=> $request->potongan,
            'tgl_mulai'=> $request->tgl_mulai,
            'tgl_akhir'=> $request->tgl_akhir,
        ]);
        Alert::success('info', 'Berhasil Di Tambah');
        return redirect()->route('Promo.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Promo  $promo
     * @return \Illuminate\Http\Response
     */
    public function show(Promo $promo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Promo  $promo
     * @return \Illuminate\Http\Response
     */
    public function edit(Promo $promo,$id)
    {
        $promo = Promo::find($id);
        return view('potongan.promo.edit', [
            'promo'=> $promo,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePromoRequest  $request
     * @param  \App\Models\Promo  $promo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePromoRequest $request, Promo $promo,$id)
    {
        Promo::where('id',$id)->update([
            'kode'=> $request->kode,
            'jenis_promo'=> $request->jenis_promo,
            'potongan'=> $request->potongan,
            'tgl_mulai'=> $request->tgl_mulai,
            'tgl_akhir'=> $request->tgl_akhir,
        ]);
        Alert::success('info', 'Berhasil Di Tambah');
        return redirect()->route('Promo.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promo  $promo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promo $promo,$id)
    {
        Promo::find($id)->delete();
        Alert::success('info', 'Berhasil Di Hapus..!');
        return redirect()->route('Promo.index');
    }
}
