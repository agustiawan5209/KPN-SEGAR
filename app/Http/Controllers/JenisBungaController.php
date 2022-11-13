<?php

namespace App\Http\Controllers;

use App\Models\JenisBunga;
use App\Http\Requests\StoreJenisBungaRequest;
use App\Http\Requests\UpdateJenisBungaRequest;
use RealRashid\SweetAlert\Facades\Alert;

class JenisBungaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jenis = JenisBunga::all();
        return view('bunga.index', compact('jenis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bunga.form', [
            'edit' => false,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreJenisBungaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreJenisBungaRequest $request)
    {
        JenisBunga::create([
            'kode'=> $request->kode,
            'jumlah_bulan' => $request->jumlah_bulan,
            'jumlah_bunga' => $request->jumlah_bunga,
        ]);
        Alert::success("Info", "Berhasil Di Tambah..!");
        return redirect()->route('JenisBunga.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JenisBunga  $jenisBunga
     * @return \Illuminate\Http\Response
     */
    public function show(JenisBunga $jenisBunga)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JenisBunga  $jenisBunga
     * @return \Illuminate\Http\Response
     */
    public function edit(JenisBunga $jenisBunga,$id)
    {
        $jenis = JenisBunga::find($id);
        return view('bunga.form', [
            'jenisBunga'=> $jenis,
            'edit'=> true
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateJenisBungaRequest  $request
     * @param  \App\Models\JenisBunga  $jenisBunga
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateJenisBungaRequest $request, JenisBunga $jenisBunga, $id)
    {
        JenisBunga::find($id)->update([
            'kode'=> $request->kode,
            'jumlah_bulan' => $request->jumlah_bulan,
            'jumlah_bunga' => $request->jumlah_bunga,
        ]);
        Alert::success("Info", "Berhasil Di edit..!");
        return redirect()->route('JenisBunga.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JenisBunga  $jenisBunga
     * @return \Illuminate\Http\Response
     */
    public function destroy(JenisBunga $jenisBunga, $id)
    {
        JenisBunga::find($id)->delete();
        Alert::success("Info", "Berhasil Di hapus..!");
        return redirect()->route('JenisBunga.index');
    }
}
