<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreVoucherRequest;
use App\Http\Requests\UpdateVoucherRequest;
use App\Models\Promo;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('potongan.voucher.index', [
            'voucher'=> Voucher::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('potongan.voucher.form');
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreVoucherRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVoucherRequest $request)
    {
        Voucher::create([
            'kode'=> $request->kode,
            'potongan'=> $request->potongan,
            'tgl_mulai'=> $request->tgl_mulai,
            'tgl_akhir'=> $request->tgl_akhir,
        ]);
        Alert::success('info', 'Berhasil Di Tambah');
        return redirect()->route('Voucher.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function show(Voucher $voucher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function edit(Voucher $voucher,$id)
    {
        $voucher = Voucher::find($id);
        return view('potongan.voucher.edit', [
            'voucher'=> $voucher,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVoucherRequest  $request
     * @param  \App\Models\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVoucherRequest $request, Voucher $voucher,$id)
    {
        Voucher::where($id)->update([
            'kode'=> $request->kode,
            'potongan'=> $request->potongan,
            'tgl_mulai'=> $request->tgl_mulai,
            'tgl_akhir'=> $request->tgl_akhir,
        ]);
        Alert::success('info', 'Berhasil Di Tambah');
        return redirect()->route('Voucher.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Voucher $voucher,$id)
    {
        Voucher::find($id)->delete();
        Alert::success('info', 'Berhasil Di Hapus..!');
        return redirect()->route('Diskon.index');
    }
}
