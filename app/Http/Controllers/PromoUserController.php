<?php

namespace App\Http\Controllers;

use App\Models\PromoUser;
use App\Http\Requests\StorePromoUserRequest;
use App\Http\Requests\UpdatePromoUserRequest;

class PromoUserController extends Controller
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
     * @param  \App\Http\Requests\StorePromoUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePromoUserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PromoUser  $promoUser
     * @return \Illuminate\Http\Response
     */
    public function show(PromoUser $promoUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PromoUser  $promoUser
     * @return \Illuminate\Http\Response
     */
    public function edit(PromoUser $promoUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePromoUserRequest  $request
     * @param  \App\Models\PromoUser  $promoUser
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePromoUserRequest $request, PromoUser $promoUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PromoUser  $promoUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(PromoUser $promoUser)
    {
        //
    }
}
