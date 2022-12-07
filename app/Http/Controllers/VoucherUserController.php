<?php

namespace App\Http\Controllers;

use App\Models\VoucherUser;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreVoucherUserRequest;
use App\Http\Requests\UpdateVoucherUserRequest;
use RealRashid\SweetAlert\Facades\Alert;

class VoucherUserController extends Controller
{
    /**
     * store
     *
     * @param  mixed $voucher_id
     * @return void
     */
    public function store($voucher_id)
    {
        $user_id = Auth::user()->id;
        $voucher = VoucherUser::where('voucher_id', '=', $voucher_id)->where('user_id', '=', $user_id)->get();
       if($voucher->count() > 0 ){
        Alert::error('Maaf!', 'Voucher Telah Terpakai');
       }else{
        VoucherUser::create([
            'voucher_id' => $voucher_id,
            'user_id' => $user_id,
            'status' => '1',
        ]);
        Alert::success('Selamat!!', 'Nikmati Potongan Anda');
       }
       return redirect()->back();
    }

    /**
     * update
     *
     * @param  mixed $voucher_id
     * @param  mixed $id
     * @return void
     */
    public function update($voucher_id, $id)
    {
        VoucherUser::where('voucher_id', '=', $voucher_id)->where('id', $id)->update([
            'status' => '2',
        ]);
    }


    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        VoucherUser::where('id', $id)->delete();
    }
}
