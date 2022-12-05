<?php

namespace App\Http\Controllers;

use App\Models\VoucherUser;
use App\Http\Requests\StoreVoucherUserRequest;
use App\Http\Requests\UpdateVoucherUserRequest;

class VoucherUserController extends Controller
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
     * @param  \App\Http\Requests\StoreVoucherUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVoucherUserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VoucherUser  $voucherUser
     * @return \Illuminate\Http\Response
     */
    public function show(VoucherUser $voucherUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VoucherUser  $voucherUser
     * @return \Illuminate\Http\Response
     */
    public function edit(VoucherUser $voucherUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVoucherUserRequest  $request
     * @param  \App\Models\VoucherUser  $voucherUser
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVoucherUserRequest $request, VoucherUser $voucherUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VoucherUser  $voucherUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(VoucherUser $voucherUser)
    {
        //
    }
}
