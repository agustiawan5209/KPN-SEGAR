<?php

namespace App\Http\Controllers;

use App\Models\Bunga;
use App\Http\Requests\StoreBungaRequest;
use App\Http\Requests\UpdateBungaRequest;

class BungaController extends Controller
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
     * @param  \App\Http\Requests\StoreBungaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBungaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bunga  $bunga
     * @return \Illuminate\Http\Response
     */
    public function show(Bunga $bunga)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bunga  $bunga
     * @return \Illuminate\Http\Response
     */
    public function edit(Bunga $bunga)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBungaRequest  $request
     * @param  \App\Models\Bunga  $bunga
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBungaRequest $request, Bunga $bunga)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bunga  $bunga
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bunga $bunga)
    {
        //
    }
}
