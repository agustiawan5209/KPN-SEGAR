<?php

namespace App\Http\Controllers;

use App\Models\Simpanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SimpananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($kode_anggota, $tgl_simpanan, $jumlah_simpanan, $total)
    {
        Simpanan::create([
            'kode_simpanan' => $this->kodeSimpanan(),
            'kode_anggota' =>$kode_anggota,
            'jumlah_simpanan' => $jumlah_simpanan,
            'tgl_simpanan' => $tgl_simpanan,
            'total' => $total,
        ]);

    }
    public function kodeSimpanan(){
        $sim = Simpanan::max('kode_simpanan');
        if($sim == null){
            $kode = "SIM-01";
        }else{
            $string = "SIM-";
            $substr = substr($sim, 4,3);
            $substr++;
            $kode = $string . sprintf("%03s", $substr);
        }
        return $kode;
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Simpanan  $simpanan
     * @return \Illuminate\Http\Response
     */
    public function show(Simpanan $simpanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Simpanan  $simpanan
     * @return \Illuminate\Http\Response
     */
    public function edit(Simpanan $simpanan, $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Request  $request
     * @param  \App\Models\Simpanan  $simpanan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Simpanan $simpanan, $id)
    {
        $this->validate($request,   [
            'kode_simpanan' => ['required', 'string'],
            'user_id' => ['required', 'string'],
            'jumlah_simpanan' => ['required', 'numeric'],
            'tgl_simpanan' => ['required', 'string'],
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Simpanan  $simpanan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Simpanan $simpanan)
    {
        //
    }
}
