<?php

namespace App\Http\Controllers;

use App\Models\LokasiPenempatan;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lokasi = LokasiPenempatan::all();
        return view('lokasi.index', compact('lokasi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $lokasi = new LokasiPenempatan();
        $lokasi->lantai = $request->lantai;
        $lokasi->ruangan = $request->ruangan;
        $lokasi->save();
        return redirect()->route('lokasi')->with('success', 'berhasil Di Update');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lokasi  = LokasiPenempatan::find($id);
        return view('lokasi.edit', compact('lokasi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lokasi  = LokasiPenempatan::find($id);
        return view('lokasi.edit', compact('lokasi'));
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
        LokasiPenempatan::where('id', $id)->update([
            'lantai'=> $request->lantai,
            'ruangan'=> $request->ruangan,
        ]);
        return redirect()->route('lokasi')->with('success', 'berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        LokasiPenempatan::find($id)->delete();
        return redirect()->route('lokasi')->with('warning', 'berhasil Di Hapus');
    }
}
