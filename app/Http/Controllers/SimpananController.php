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
    public function store(Request $request)
    {
        $this->validate($request,   [
            'kode_simpanan' => ['required', 'string'],
            'user_id' => ['required', 'string'],
            'jumlah_simpanan' => ['required', 'numeric'],
            'tgl_simpanan' => ['required', 'string'],
        ]);
        $simpanan = Simpanan::where('user_id', Auth::user()->id)->get();
        if ($simpanan->count() > 0) {
            $jumlah_simpanan = Simpanan::where('user_id', Auth::user()->id)->sum('total');
            Simpanan::create([
                'kode_simpanan' => $request->kode_simpanan,
                'user_id' => Auth::user()->id,
                'jumlah_simpanan' => $request->jumlah_simpanan,
                'tgl_simpanan' => $request->tgl_simpanan,
                'total' => $request->jumlah_simpanan + $jumlah_simpanan,
            ]);
        } else {
            Simpanan::create([
                'kode_simpanan' => $request->kode_simpanan,
                'user_id' => Auth::user()->id,
                'jumlah_simpanan' => $request->jumlah_simpanan,
                'tgl_simpanan' => $request->tgl_simpanan,
                'total' => $request->jumlah_simpanan,
            ]);
        }
        //
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
