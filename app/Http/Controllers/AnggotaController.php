<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Support\Str;
use App\Models\DetailAnggota;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreAnggotaRequest;
use App\Http\Requests\UpdateAnggotaRequest;
use RealRashid\SweetAlert\Facades\Alert;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function daftar()
    {
        return view('anggota.daftar');
    }
    public function form()
    {
        $angg = Anggota::where('user_id', Auth::user()->id)->first();
        if ($angg != null) {
            if ($angg->status == 1) {
                Alert::success("Info", 'Anda Sudah Terdaftar Menjadi Anggota');
            } else {
                Alert::success("Anda Sudah Terdaftar Menjadi Anggota", 'Mohon Menunggu Konfirmasi Pihak Yang Bersangkutan');
            }
            return redirect()->route('Customer.Index');
        } else {
            return view('anggota.form');
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status = Auth::user()->anggota->status;
        // dd(Auth::user()->anggota->status);
        if($status == 0){
            Alert::success('info', 'Mohon menunggu konfirmasi');
            return redirect()->route('Customer.Index');
        }else{
            return redirect()->route('dashboardUser');
        }
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
     * @param  \App\Http\Requests\StoreAnggotaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAnggotaRequest $request)
    {
        $angg = Anggota::where('user_id', Auth::user()->id)->first();
        if ($angg != null) {
            if ($angg->status == 1) {
                Alert::success("Info", 'Anda Sudah Terdaftar Menjadi Anggota');
            } else {
                Alert::success("Anda Sudah Terdaftar Menjadi Anggota", 'Mohon Menunggu Konfirmasi Pihak Yang Bersangkutan');
            }
        } else {
            $anggota = Anggota::create([
                'kode_anggota' => Auth::user()->username . Str::random(3),
                'user_id' => Auth::user()->id,
                'status' => '0',
            ]);
            $detail = DetailAnggota::create([
                'anggota_id' => $anggota->id,
                'nama_lengkap' => $request->nama_lengkap,
                'foto_ktp' => $request->foto_ktp,
                'pekerjaan' => $request->pekerjaan,
                'gaji' => $request->gaji,
                'pendidikan' => $request->pendidikan,
                'tempat_lahir' => $request->tempat_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'jenkel' => $request->jenkel,
                'status' => $request->status,
                'tanggungan' => $request->tanggungan,
            ]);
        }
        return redirect()->route('Customer.Index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Anggota  $anggota
     * @return \Illuminate\Http\Response
     */
    public function show(Anggota $anggota)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Anggota  $anggota
     * @return \Illuminate\Http\Response
     */
    public function edit(Anggota $anggota)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAnggotaRequest  $request
     * @param  \App\Models\Anggota  $anggota
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAnggotaRequest $request, Anggota $anggota)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Anggota  $anggota
     * @return \Illuminate\Http\Response
     */
    public function destroy(Anggota $anggota)
    {
        //
    }
}
