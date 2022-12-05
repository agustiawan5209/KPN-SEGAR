<?php

namespace App\Http\Controllers;

use App\Models\Diskon;
use App\Http\Requests\StoreDiskonRequest;
use App\Http\Requests\UpdateDiskonRequest;
use App\Models\Barang;
use RealRashid\SweetAlert\Facades\Alert;

class DiskonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('diskon.index', [
            'diskon'=> Diskon::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $barang = Barang::all();
        return view('diskon.form',[
            'barang'=> $barang
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDiskonRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDiskonRequest $request)
    {
        Diskon::create([
            'barang_id'=> $request->barang_id,
            'diskon'=> $request->diskon,
            'tgl_mulai'=> $request->tgl_mulai,
            'tgl_akhir'=> $request->tgl_akhir,
        ]);
        Alert::success('info', 'Berhasil Di Tambah');
        return redirect()->route('Diskon.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Diskon  $diskon
     * @return \Illuminate\Http\Response
     */
    public function show(Diskon $diskon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Diskon  $diskon
     * @return \Illuminate\Http\Response
     */
    public function edit(Diskon $diskon, $id)
    {
        $diskon = Diskon::find($id);
        $barang = Barang::all();
        return view('diskon.edit', [
            'diskon'=> $diskon,
            'barang'=> $barang,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDiskonRequest  $request
     * @param  \App\Models\Diskon  $diskon
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDiskonRequest $request, Diskon $diskon,$id)
    {
        Diskon::where('id', $id)->update([
            'barang_id'=> $request->barang_id,
            'diskon'=> $request->diskon,
            'tgl_mulai'=> $request->tgl_mulai,
            'tgl_akhir'=> $request->tgl_akhir,
        ]);
        Alert::success('info', 'Berhasil Di Edit..!');
        return redirect()->route('Diskon.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Diskon  $diskon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Diskon $diskon, $id)
    {
        Diskon::find($id)->delete();
        Alert::success('info', 'Berhasil Di Hapus..!');
        return redirect()->route('Diskon.index');
    }
}
