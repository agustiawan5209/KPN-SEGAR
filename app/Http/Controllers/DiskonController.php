<?php

namespace App\Http\Controllers;

use App\Models\Diskon;
use App\Http\Requests\StoreDiskonRequest;
use App\Http\Requests\UpdateDiskonRequest;

class DiskonController extends Controller
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
     * @param  \App\Http\Requests\StoreDiskonRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDiskonRequest $request)
    {
        //
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
    public function edit(Diskon $diskon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDiskonRequest  $request
     * @param  \App\Models\Diskon  $diskon
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDiskonRequest $request, Diskon $diskon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Diskon  $diskon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Diskon $diskon)
    {
        //
    }
}
