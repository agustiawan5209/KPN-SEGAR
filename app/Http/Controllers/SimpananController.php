<?php

namespace App\Http\Controllers;

use App\Models\Pinjam;
use App\Models\Anggota;
use App\Models\Simpanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class SimpananController extends Controller
{

    public function __construct()
    {
        // if(Auth::user()->anggota->kode_anggota == null){
        //     abort('403');
        // }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Auth::user()->roles_id == 2){
            $simp = Simpanan::where('kode_anggota', '=' , Auth::user()->anggota->kode_anggota)->get();
        }else{
            $simp = Simpanan::where('kode_anggota', '=' , $request->kode_anggota)->get();
        }
        return view('simpanan.index',[
            'simpan'=> $simp,
            'kode_anggota'=> $request->kode_anggota,

        ]);
    }
    public function riwayatPinjaman()
    {
        $simp = Pinjam::where('kode_anggota', '=' , Auth::user()->anggota->kode_anggota)->get();
        return view('simpanan.riwayatpinjam',[
            'pinjam'=> $simp,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($request->kode_anggota == null){
            $anggota = Anggota::all();
        }else{
            $anggota = Anggota::where('kode_anggota', $request->kode_anggota)->get();

        }
        return view('simpanan.form',[
            'anggota'=> $anggota,
            'kode_anggota'=> $request->kode_anggota,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($kode_anggota = null, $tgl_simpanan = null, $kredit = null,$debit = null,  $total = null)
    {
        Simpanan::create([
            'kode_simpanan' => $this->kodeSimpanan(),
            'kode_anggota' =>$kode_anggota,
            'tgl_simpanan' => $tgl_simpanan,
            'kredit' => $kredit,
            'debit' => $debit,
            'total' => $total,
        ]);

    }
    public function createSimpanan(Request $request){
        $valid =  $this->validate($request,   [
            'kode_anggota' => ['required', 'string'],
            'debit' => ['required', 'numeric'],
            'kredit' => ['required', 'numeric'],
            'tgl_simpanan' => ['required', 'date'],
        ]);
        // dd($valid);
        Simpanan::create([
            'kode_simpanan' => $this->kodeSimpanan(),
            'kode_anggota' =>$request->kode_anggota,
            'tgl_simpanan' => $request->tgl_simpanan,
            'kredit' => $request->kredit,
            'debit' => $request->debit,
            'total' => $request->debit - $request->kredit,
        ]);
        Alert::success('Berhasil', 'Simpanan '. $request->kode_anggota .' Berhasil Di Tambah');
        return redirect()->route('simpanan.index', ['kode_anggota'=> $request->kode_anggota]);
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
    public function edit(Simpanan $simpanan, $id, Request $request)
    {
        $simpanan = $simpanan->find($id);
        return view('simpanan.edit',[
            'simpanan'=> $simpanan,
        ]);
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
            'kode_anggota' => ['required', 'string'],
            'debit' => ['required', 'numeric'],
            'kredit' => ['required', 'numeric'],
            'tgl_simpanan' => ['required', 'date'],
        ]);

        $simpanan->find($id)->update([
            'kode_simpanan' => $this->kodeSimpanan(),
            'kode_anggota' =>$request->kode_anggota,
            'tgl_simpanan' => $request->tgl_simpanan,
            'kredit' => $request->kredit,
            'debit' => $request->debit,
            'total' => $request->debit - $request->kredit,
        ]);
        Alert::success('Berhasil', 'Simpanan '. $request->kode_anggota .' Berhasil Di Edit');
        return redirect()->route('simpanan.index', ['kode_anggota'=> $request->kode_anggota]);
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
